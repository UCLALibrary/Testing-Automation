<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Trigger;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class Github extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    protected $categories;

    protected $set;

    protected $wait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //get the categories to run and the var set
        $this->categories = json_decode(Trigger::where('namespace', '=', 'github')->where('key', '=', 'categories')->first()->value, true);
        $this->set = Trigger::where('namespace', '=', 'github')->where('key', '=', 'set')->first()->value;
        $this->set = Trigger::where('namespace', '=', 'github')->where('key', '=', 'wait')->first()->value;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if(!empty($this->categories)) {
            foreach ($this->categories as $category) {
                $this->dispatch(
                    (new Categories($category, $this->set))->delay($this->wait)
                );
            }
        }
    }
}
