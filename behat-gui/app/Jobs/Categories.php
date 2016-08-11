<?php

namespace App\Jobs;

use App\Category;
use App\Jobs\Job;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Categories extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    protected $category;
    protected $auth;
    protected $set;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request, $category, $set)
    {
        $this->category = $category;
        $this->auth = $request;
        $this->set = $set;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //get the category that we are going to use to queue all of the files.
        //get all of the test_ids for the category
        $tests = Category::where('category', '=', $this->category)->get();
        foreach($tests as $test) {
            if(isset($test->test_id) && $test->test_id != null) {
                $this->dispatch(
                    new Execute($this->auth, $test->test_id, $this->set)
                );
            }
        }
    }
}
