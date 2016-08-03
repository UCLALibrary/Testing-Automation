<?php

namespace App\Console;

use App\Scheduler;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Schema;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\ExecuteFeature::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      if(Schema::hasTable('schedulers')){
        if(class_exists('App\Scheduler')) {
            foreach (Scheduler::all() as $s) {
                if($s->disabled == 0){
                  $schedule->command($s['command'], [$s['parameters']])->$s['frequency']();
                }
            }
        }
      }
    }
}
