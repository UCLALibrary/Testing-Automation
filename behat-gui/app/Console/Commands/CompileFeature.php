<?php

namespace App\Console\Commands;

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
    {testNumber : The template to use for converting to a real feature file}';

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
        $t = Test::where('id', '=', $test)->first();
        $file = file_get_contents($t->location);
        $data = '';

        foreach(Variable::all() as $v){
            $data = str_replace("[".$v->key."]", $v->value, $file);
        }

        sleep(1);
        $name = explode('.', $t->location)[0];

        $file = gherkin_cleaner($data);

        $f = fopen($name.".feature", "w");
        fwrite($f, $file);
        fclose($f);
    }
}
