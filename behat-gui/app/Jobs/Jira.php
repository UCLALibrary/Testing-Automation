<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Notifications;
use App\Test;
use App\TestResult;
use App\Trigger;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use PHPHtmlParser\Dom;

class Jira extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels, DispatchesJobs;

    protected $test_id;
    protected $result;
    protected $success;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($test_id, $result, $success)
    {
        $this->test_id = $test_id;
        $this->test = Test::where('id', '=', $test_id)->first();
        $this->result = TestResult::where('test_id', '=', $test_id)->orderBy('created_at', 'desc')->first();
        $this->success = $success;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $assign = Trigger::where('namespace', '=', 'jira')->where('key', '=', 'assign')->first();
        $labels = Trigger::where('namespace', '=', 'jira')->where('key', '=', 'label')->first();
        $project = Trigger::where('namespace', '=', 'jira')->where('key', '=', 'project')->first();
        if($this->success == 0) {
            $headers = array(
                'Accept: application/json',
                'Content-Type: application/json'
            );

            $dom = new Dom();
            $dom->load($this->result->result);
            $name = $dom->find('a[data-toggle=collapse]');
            $description = '';
            foreach ($name as $n) {
                $items = $dom->find('li');
                $result = [];
                foreach ($items as $item) {
                    $color = 'black';
                    if (strpos($item->class, "alert-warning") !== false) {
                        $color = '#f79232';
                    } elseif (strpos($item->class, "alert-danger") !== false) {
                        $color = '#d04437';
                    } elseif (strpos($item->class, "alert-success") !== false) {
                        $color = '#14892c';
                    } elseif (strpos($item->class, "alert-info") !== false) {
                        $color = '#59afe1';
                    }

                    $result[] = [
                        'line' => $item->text,
                        'color' => $color
                    ];
                }

                $description .= "{panel:title=Behat Output:" . trim($n->text) . "}";

                foreach ($result as $k => $r) {
                    $description .= "{color:" . $result[$k]['color'] . "}" . $result[$k]['line'] . "{color}\n";
                }

                $description .= "{panel}";
            }

            $description .= "{panel:title=Analysis}" . $this->result->comment . "{panel}";

            $post = array(
                'fields' => array(
                    'project' => array(
                        'key' => $project->value
                    ),
                    'summary' => 'Test Results: ' . $this->test_id,
                    'description' => $description,
                    'issuetype' => [
                        'id' => 1
                    ],
                    'assignee' => [
                        'name' => $assign->value
                    ],
                    'labels' => json_decode($labels->value, true),
                )
            );


            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_VERBOSE, 1);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_USERPWD, config('jira.username') . ":" . config('jira.password'));
            curl_setopt($curl, CURLOPT_URL, config('jira.url') . '/rest/api/2/issue');
            curl_setopt($curl, CURLOPT_POST, count($post));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($post));

            $response = curl_exec($curl);
            $response = json_decode($response, true);
            $this->result->jira_id = $response['id'];
            $this->result->jira_key = $response['key'];
            $this->result->jira_url = $response['self'];
            $this->result->save();
            curl_close($curl);

            Notifications::firstOrCreate(['message' => 'JIRA ticket created.']);
        }else{
            $this->delete();
        }
    }
}
