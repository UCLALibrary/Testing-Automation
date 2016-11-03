<?php

namespace App\Jobs;

use App\Group;
use App\Jobs\Job;
use App\Notifications;
use App\Test;
use App\TestResult;
use App\Variable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use \Behat\Gherkin\Lexer;
use \Behat\Gherkin\Parser;
use \Behat\Gherkin\Keywords\ArrayKeywords;
use Illuminate\Support\Facades\Auth;

class ExecuteFeature extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    protected $test;
    protected $auth;
    protected $set;
    protected $group;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $test, $set, $group)
    {
        $this->auth = $request;
        $this->test = $test;
        $this->set = $set;
        $this->group = $group;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $test = $this->test;
        $set = $this->set;
        $t = Test::where('id', '=', $test)->first();
        
        $location = $t->location;

        /*
         * Sanitize white spaces in uploaded file.
         */
        $file = file_get_contents($location);
        $file = str_replace(" ", " ", $file);

        /*
         * Create copy of uploaded file content with variables subbed in.
         */
        $s = "/\[([a-zA-Z\/_]+)\]/";
        preg_match_all($s, $file, $match);
        foreach ($match[1] as $m) {
            $variable = Variable::where('key', '=', $m)->first();
            if (!empty($variable)) {
                $sets = json_decode($variable->sets);
                if (in_array($set, $sets)) {
                    if (isset(json_decode($variable->value)[$set]) && json_decode($variable->value)[$set] != null) {
                        $file = str_replace("[" . $m . "]", '"' . json_decode($variable->value)[$set] . '"', $file);
                    } elseif (!isset(json_decode($variable->value)[$set]) || json_decode($variable->value)[$set] == null) {
                        $file = str_replace("[" . $m . "]", '"' . json_decode($variable->value)[0] . '"', $file);
                    } else {
                        $file = str_replace("[" . $m . "]", '"' . json_decode($variable->value)[0] . '"', $file);
                    }
                } else {
                    $file = str_replace("[" . $m . "]", '"' . json_decode($variable->value)[0] . '"', $file);
                }
            }
        }

        $data = $file;

        $file_name = explode('.', $t->location)[0];

        $keywords = new ArrayKeywords([
            'en' => array(
                'feature' => 'Feature',
                'background' => 'Background',
                'scenario' => 'Scenario',
                'scenario_outline' => 'Scenario Outline|Scenario Template',
                'examples' => 'Examples|Scenarios',
                'given' => 'Given',
                'when' => 'When',
                'then' => 'Then',
                'and' => 'And',
                'but' => 'But'
            )
        ]);

        /*
         * Create feature file from template.
         */
        $lexer = new Lexer($keywords);
        $parser = new Parser($lexer);

        $info = $parser->parse($data);
        $file = '# language: ' . $info->getLanguage();

        foreach ($info->getTags() as $te) {
            $file .= "\n@" . $te;
        }

        $file .= "\nFeature: " . $info->getTitle();
        foreach (explode("\n", $info->getDescription()) as $d) {
            $file .= "\n  " . trim($d);
        }

        if ($info->getBackground() !== null) {
            $background = $info->getBackground();
            $file .= "\n\n  " . $background->getKeyword() . ": ";
            if ($background->getTitle() != null) {
                $file .= $background->getTitle();
            }

            foreach ($background->getSteps() as $step) {
                $file .= "\n    " . trim($step->getKeyword()) . " " . trim($step->getText());
            }
        }

        $file .= "\n";
        foreach ($info->getScenarios() as $s) {
            foreach ($s->getTags() as $te) {
                $file .= "\n  @" . $te;
            }
            $file .= "\n  " . $s->getKeyword() . ": ";
            foreach (explode("\n", $s->getTitle()) as $k => $te) {
                if ($k == 0) {
                    $file .= trim($te);
                } else {
                    $file .= "\n    " . trim($te);
                }
            }
            foreach ($s->getSteps() as $step) {

                $string = $step->getKeyword() . " " . $step->getText();
                $file .= "\n    " . $string;
            }


        }

        $f = fopen($file_name . ".feature", "w");
        fwrite($f, $file);
        fclose($f);


        Notifications::firstOrCreate(['message' => $t->name . ' was compiled']);

        /*
         * Execute behat on newly created feature file.
         */

        $name = explode('.', $t->location)[0];

        exec(base_path() . '/bin/behat --format html ' . $name . '.feature', $output);

        /*
         * Get the HTML output from features/report.
         */
        libxml_use_internal_errors(true);
        if (file_exists('features/report/default.html')) {
            $html = file_get_contents('features/report/default.html');
            $dom = new \DOMDocument();
            $dom->loadHTML($html);
            $xpath = new \DOMXPath($dom);
            $div = $xpath->query('//div[@class="col-sm-8 details panel-group"]');
            $div = $div->item(0);
            $r = $dom->saveXML($div);
        }
        libxml_use_internal_errors(false);



        if (isset($r) && $r != null) {
            $s = true;
            if (strpos($r, "alert-warning") !== false) {
                $s = false;
            } elseif (strpos($r, "alert-danger") !== false) {
                $s = false;
            }

            /*
             * Push result as a new result in database.
             */
            $result = new TestResult();
            $result->test_id = $t->id;
            $result->result = $this->sanitize_output($r);
            $result->success = $s;

            /*This portion of the code interferes with Git Webhook execution. id is not identified in $this->auth->id. */
            //if($this->auth->id == null){

            //if (!is_null($this->auth)){
                $result->user_id = 0;
            //}else {
                //$result->user_id = $this->auth->id;
            //}

            $result->save();

            
            $group = Group::where('id', '=', $this->group)->first();
            $results_array = $group->results;
            $results_array[] = $result->id;
            $tests_array = $group->tests;
            $tests_array[] = $result->test_id;
            $group->results = $results_array;
            $group->tests = $tests_array;
            if($s == 0){
                $group->status = 0;
            }

            $group->save();
        }

        /*
         * Cleanup temporary files.
         */
        rrmdir('features/report');
        unlink($name . ".feature");

        Notifications::firstOrCreate(['message' => $t->name . ' was executed']);

        $this->dispatch(new FriendlyMessages());

        /*
         * Create JIRA ticket.
         */
        if (isset($r) && $r != null) {
            $this->dispatch(new Jira($test, $this->sanitize_output($r), $s));
        }

        return redirect()->route('tests.index')->with('message', 'done');
        
    }


    function sanitize_output($buffer) {

        $search = array(
            '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
            '/[^\S ]+\</s',  // strip whitespaces before tags, except space
            '/(\s)+/s'       // shorten multiple whitespace sequences
        );

        $replace = array(
            '>',
            '<',
            '\\1'
        );

        $buffer = preg_replace($search, $replace, $buffer);

        return $buffer;
    }
}
