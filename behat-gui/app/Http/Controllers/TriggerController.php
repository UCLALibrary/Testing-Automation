<?php

namespace App\Http\Controllers;

use Auth;
use App\Notifications;
use App\CategoryItem;
use App\Jobs\Github;
use App\Set;
use App\Trigger;
use Illuminate\Http\Request;

use App\Http\Requests;

class TriggerController extends Controller
{
    /**
     * When github sends a payload, dispatch Github() so that tests
     * will be executed according to previously configured settings.
     *
     * @param  Request $request
     * @return Response
     */
    public function github(Request $request){
        $request_content = $request->getContent();
        $content = json_decode($request_content,true);
        $id = $content['sender']['id'];

        $this->dispatchNow(
          new Github($id)
        );
        Notifications::firstOrCreate(['message' => 'Github webhook dispatch successful.']);

        return $id;
    }

    /**
     * Create trigger instances to save submitted data.
     * Each trigger corresponds to a category in table behat > triggers.
     *
     * @param  Request $request
     * @return Response
     */
    public function github_config_post(Request $request){
        $github_categories = Trigger::firstOrNew(['key' => 'categories', 'namespace' => 'github', 'user' => Auth::user()->github_id]);
        $github_categories->value = json_encode($request->input('categories'));
        $github_categories->save();

        $github_set = Trigger::firstOrNew(['key' => 'set', 'namespace' => 'github', 'user' => Auth::user()->github_id]);
        $github_set->value = $request->input('set');
        $github_set->save();

        $github_wait = Trigger::firstOrNew(['key' => 'wait', 'namespace' => 'github', 'user' => Auth::user()->github_id]);
        $github_wait->value = $request->input('wait');
        $github_wait->save();

        return redirect()->route('triggers.github');
    }

    /**
     * Pass necessary variables to /github view so that configured settings can be displayed.
     *
     * @return Response
     */
    public function github_config(){
        $it = [];
        $items = CategoryItem::all();
        foreach($items as $i){
            $it[$i->header][] = $i->value;
        }

        view()->share('wait', Trigger::where('namespace', '=', 'github')->where('key', '=', 'wait')->where('user', '=', Auth::user()->github_id)->first());
        view()->share('categories', Trigger::where('namespace', '=', 'github')->where('key', '=', 'categories')->where('user', '=', Auth::user()->github_id)->first());
        view()->share('set', Trigger::where('namespace', '=', 'github')->where('key', '=', 'set')->where('user', '=', Auth::user()->github_id)->first());
        view()->share('sets', Set::all());
        view()->share('items', $it);
        return view('triggers.github');
    }

    /**
     * Create trigger instances to save submitted data.
     * Each trigger corresponds to a category in table behat > triggers
     *
     * @param  Request $request
     * @return Response
     */
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

    /**
     * Pass necessary variables to /jira view so that configured settings can be displayed.
     *
     * @return Response
     */
    public function jira_config(){
        view()->share('assign', Trigger::where('namespace', '=', 'jira')->where('key', '=', 'assign')->first());
        view()->share('label', Trigger::where('namespace', '=', 'jira')->where('key', '=', 'label')->first());
        view()->share('project', Trigger::where('namespace', '=', 'jira')->where('key', '=', 'project')->first());
        return view('triggers.jira');
    }
}
