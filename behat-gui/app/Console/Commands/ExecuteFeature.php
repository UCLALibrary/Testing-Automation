<?php

namespace App\Console\Commands;

use App\Test;
use App\TestResult;
use Illuminate\Console\Command;

class ExecuteFeature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'behat:execute
    {testNumber : The template to use for converting to a real feature file}
    {setNumber : The set to use variables against}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Executes the feature file and saves the output to the database';

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
        $this->call('behat:compile', ["testNumber" => $this->argument('testNumber'), 'setNumber' => $this->argument('setNumber')]);

        $test = $this->argument('testNumber');
        $t = Test::where('id', '=', $test)->first();
        $name = explode('.', $t->location)[0];
        exec('/Users/ryangurnick/Desktop/Behat-GUI/bin/behat --format html '. $name.".feature", $output);

        libxml_use_internal_errors(true);
        if(file_exists('features/report/default.html')) {
            $html = file_get_contents('features/report/default.html');
            $dom = new \DOMDocument();
            $dom->loadHTML($html);
            $xpath = new \DOMXPath($dom);
            $div = $xpath->query('//div[@class="col-sm-8 details panel-group"]');
            $div = $div->item(0);
            $r = $dom->saveXML($div);
        }
        libxml_use_internal_errors(false);

        if(isset($r) && $r != null) {
            $s = true;
            if(strpos($r, "alert-warning") !== false){
                $s = false;
            }elseif(strpos($r, "alert-danger") !== false){
                $s = false;
            }

            $result = new TestResult();
            $result->test_id = $t->id;
            $result->result = $r;
            $result->success = $s;
            $result->save();
        }

        rrmdir('features/report');
        unlink($name.".feature");
    }
}
