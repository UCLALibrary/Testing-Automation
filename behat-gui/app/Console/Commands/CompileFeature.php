<?php

namespace App\Console\Commands;

use \Behat\Gherkin\Lexer;
use \Behat\Gherkin\Parser;
use \Behat\Gherkin\Keywords\ArrayKeywords;
use App\Test;
use App\Variable;
use Illuminate\Console\Command;

class CompileFeature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'behat:compile
    {testNumber : The template to use for converting to a real feature file}
    {setNumber : The set to use variables against}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Removes variables from gherkin and puts in value';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $test = $this->argument('testNumber');
        $set = $this->argument('setNumber');
        $t = \App\Test::where('id', '=', $test)->first();
        dd($t);
        $file = file_get_contents($t->location);
        $file = str_replace(" ", " ", $file);

        $s = "/\[([a-zA-Z\/_]+)\]/";
        preg_match_all($s, $file, $match);
        foreach($match[1] as $m) {
            $variable = Variable::where('key', '=', $m)->first();
            if(!empty($variable)) {
                $sets = json_decode($variable->sets);
                if (in_array($set, $sets)) {
                    if (isset(json_decode($variable->value)[$set]) && json_decode($variable->value)[$set] != null) {
                        $file = str_replace("[" . $m . "]", json_decode($variable->value)[$set], $file);
                    } elseif (!isset(json_decode($variable->value)[$set]) || json_decode($variable->value)[$set] == null) {
                        $file = str_replace("[" . $m . "]", json_decode($variable->value)[0], $file);
                    } else {
                        $file = str_replace("[" . $m . "]", json_decode($variable->value)[0], $file);
                    }
                } else {
                    $file = str_replace("[" . $m . "]", json_decode($variable->value)[0], $file);
                }
            }
        }

        $data = $file;

        $name = explode('.', $t->location)[0];

        $keywords = new ArrayKeywords([
            'en' => array(
                'feature'          => 'Feature',
                'background'       => 'Background',
                'scenario'         => 'Scenario',
                'scenario_outline' => 'Scenario Outline|Scenario Template',
                'examples'         => 'Examples|Scenarios',
                'given'            => 'Given',
                'when'             => 'When',
                'then'             => 'Then',
                'and'              => 'And',
                'but'              => 'But'
            )
        ]);

        $lexer = new Lexer($keywords);
        $parser = new Parser($lexer);

        $info = $parser->parse($data);
        $file = '# language: '. $info->getLanguage();

        foreach($info->getTags() as $t){
            $file .= "\n@". $t;
        }

        $file .= "\nFeature: ". $info->getTitle();
        foreach(explode("\n", $info->getDescription()) as $d){
            $file .= "\n  ". trim($d);
        }

        if($info->getBackground() !== null) {
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
        foreach($info->getScenarios() as $s){
            foreach($s->getTags() as $t){
                $file .= "\n  @". $t;
            }
            $file .= "\n  ".$s->getKeyword(). ": ";
            foreach(explode("\n", $s->getTitle()) as $k => $t){
                if($k == 0){
                    $file .= trim($t);
                }else{
                    $file .= "\n    " . trim($t);
                }
            }
            foreach($s->getSteps() as $step){

                $string = $step->getKeyword(). " ". $step->getText();
                $file .= "\n    ".$string;
            }


        }

        $f = fopen($name.".feature", "w");
        fwrite($f, $file);
        fclose($f);

    }
}
