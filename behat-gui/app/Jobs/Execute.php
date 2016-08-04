<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Artisan;

class Execute extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    protected $id;
    protected $set;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $set)
    {
        $this->id = $id;
        $this->set = $set;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->dispatch(
            new ExecuteFeature($this->id, $this->set)
        );
    }
}
