<?php

namespace App\Console\Commands;

use App\Jobs\Execute;
use App\Jobs\Jira;
use App\Notifications;
use App\Test;
use App\TestResult;
use Illuminate\Console\Command;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Artisan;

class ExecuteFeature extends Command
{
    use DispatchesJobs;

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
        $this->dispatch(
            new Execute($this->argument('testNumber'), $this->argument('setNumber'))
        );
    }

}
