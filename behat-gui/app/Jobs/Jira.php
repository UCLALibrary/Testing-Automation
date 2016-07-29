<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Test;
use App\TestResult;
use App\Trigger;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        $this->result = TestResult::where('test_id', '=', $test_id)->orderBy('created_at', 'desc')->get();
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

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json'
        );

        $post = array(
            'fields' => array(
                'project' => array(
                    'key' => $project->value
                ),
                'summary' => 'Test Results: '. $this->test_id,
                'description' => htmlentities("Behat Output:\n".$this->result->result."\n\nAnalysis:".$this->result->comment),
                'issuetype' => [
                    'id' => 1
                ],
                'assignee' => [
                    'name' => $assign->value
                ],
                'labels' => json_decode($labels->value, true),
            )
        );

        dump($post);


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_USERPWD, config('jira.username').":".config('jira.password'));
        curl_setopt($curl, CURLOPT_URL, "https://jira.library.ucla.edu/rest/api/2/issue");
        curl_setopt($curl,CURLOPT_POST, count($post));
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($post));

        $response = curl_exec($curl);

        dump($response);

        $curl_error = curl_error($curl);

        dump($curl_error);

        curl_close($curl);

        if($this->success == 0){
            $this->dispatch(
                new JiraFailed($this->test_id, $this->result)
            );
        }
    }
}
