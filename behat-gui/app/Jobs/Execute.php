<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Artisan;

class Execute extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    protected $id;
    protected $request;
    protected $set;
    protected $group;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $id, $set, $group)
    {
        $this->id = $id;
        $this->request = $request;
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
        $this->dispatch(
            new ExecuteFeature($this->request, $this->id, $this->set, $this->group)
        );
    }
}
