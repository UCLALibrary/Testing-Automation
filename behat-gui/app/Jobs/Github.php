<?php

//use Auth;
namespace App\Jobs;

use App\Notifications;
//use App\Http\Controllers\Auth;

use App\Group;
use App\Jobs\Job;
use App\Trigger;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;

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
        $c = Trigger::where('namespace', '=', 'github')->where('key', '=', 'categories')->where('user','=',$request)->first();
        $s = Trigger::where('namespace', '=', 'github')->where('key', '=', 'set')->where('user','=',$request)->first();
        $w = Trigger::where('namespace', '=', 'github')->where('key', '=', 'wait')->where('user','=',$request)->first();

        $this->request = $request;
        $this->categories = json_decode($c->value, true);
        $this->set = $s->value;
        $this->wait = $w->value;
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
