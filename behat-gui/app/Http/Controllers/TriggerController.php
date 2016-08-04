<?php

namespace App\Http\Controllers;

use App\CategoryItem;
use App\Jobs\Github;
use App\Set;
use App\Trigger;
use Illuminate\Http\Request;

use App\Http\Requests;

class TriggerController extends Controller
{
    /*
     * When github sends a payload...
     *
     * do something.
     *
     */
    public function github(Request $request){
        # at some point in the future specify when this will run.
        $this->dispatchNow(
          new Github()
        );
    }

    public function github_config_post(Request $request){
        $github_categories = Trigger::firstOrNew(['key' => 'categories', 'namespace' => 'github']);
        $github_categories->value = json_encode($request->input('categories'));
        $github_categories->save();

        $github_set = Trigger::firstOrNew(['key' => 'set', 'namespace' => 'github']);
        $github_set->value = $request->input('set');
        $github_set->save();

        $github_wait = Trigger::firstOrNew(['key' => 'wait', 'namespace' => 'github']);
        $github_wait->value = $request->input('wait');
        $github_wait->save();


        return redirect()->route('triggers.github');
    }

    public function github_config(){
        $it = [];
        $items = CategoryItem::all();
        foreach($items as $i){
            $it[$i->header][] = $i->value;
        }

        view()->share('wait', Trigger::where('namespace', '=', 'github')->where('key', '=', 'wait')->first());
        view()->share('categories', Trigger::where('namespace', '=', 'github')->where('key', '=', 'categories')->first());
        view()->share('set', Trigger::where('namespace', '=', 'github')->where('key', '=', 'set')->first());
        view()->share('sets', Set::all());
        view()->share('items', $it);
        return view('triggers.github');
    }

    public function jira_config_post(Request $request){
            $jira_assign = Trigger::firstOrNew(['key' => 'assign', 'namespace' => 'jira']);
            $jira_assign->value = $request->input('assign');
            $jira_assign->save();

            $jira_label = Trigger::firstOrNew(['key' => 'label', 'namespace' => 'jira']);
            $jira_label->value = json_encode(explode(",", $request->input('labels')));
            $jira_label->save();

            $jira_project = Trigger::firstOrNew(['key' => 'project', 'namespace' => 'jira']);
            $jira_project->value = $request->input('project');
            $jira_project->save();

        return redirect()->route('triggers.jira');
    }

    public function jira_config(){

        view()->share('assign', Trigger::where('namespace', '=', 'jira')->where('key', '=', 'assign')->first());
        view()->share('label', Trigger::where('namespace', '=', 'jira')->where('key', '=', 'label')->first());
        view()->share('project', Trigger::where('namespace', '=', 'jira')->where('key', '=', 'project')->first());
        return view('triggers.jira');
    }
}
