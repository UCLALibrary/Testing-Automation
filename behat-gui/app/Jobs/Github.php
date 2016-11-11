<?php

namespace App\Jobs;

use App\Notifications;

use App\Group;
use App\Jobs\Job;
use App\Trigger;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class Github extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    protected $categories;

    protected $request;

    protected $set;

    protected $wait;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($request)
    {
        //get the categories to run and the var set
        $this->request = $request;
        $this->categories = json_decode(Trigger::where('namespace', '=', 'github')->where('key', '=', 'categories')->where('user', '=', Auth::user()->github_id)->first()->value, true);
        $this->set = Trigger::where('namespace', '=', 'github')->where('key', '=', 'set')->where('user', '=', Auth::user()->github_id)->first()->value;
        $this->set = Trigger::where('namespace', '=', 'github')->where('key', '=', 'wait')->where('user', '=', Auth::user()->github_id)->first()->value;
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
                if (!is_null(Auth::user())) {
                    $group = Group::create(['user_id' => Auth::user()->id]);
                } else {
                    $group = Group::create(['user_id' => 1]);
                }

                $this->dispatch(
                    (new Categories($this->request, $category, $this->set, $group->id))->delay($this->wait)
                );
            }
        }
    }
}
