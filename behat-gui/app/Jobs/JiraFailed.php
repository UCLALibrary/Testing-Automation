<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class JiraFailed extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $test_id;
    protected $result;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($test_id, $result)
    {
        $this->test_id = $test_id;
        $this->result = $result;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
