<?php

namespace App\Console\Commands;

use App\Test;
use App\TestResult;
use App\Trigger;
use Illuminate\Console\Command;
use PHPHtmlParser\Dom;

class Testing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'behat:testing';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testing some stuff';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $test_id = 8;

        $this->test_id = $test_id;
        $this->test = Test::where('id', '=', $test_id)->first();
        $this->result = TestResult::where('test_id', '=', $test_id)->orderBy('created_at', 'desc')->first();

        $assign = Trigger::where('namespace', '=', 'jira')->where('key', '=', 'assign')->first();
        $labels = Trigger::where('namespace', '=', 'jira')->where('key', '=', 'label')->first();
        $project = Trigger::where('namespace', '=', 'jira')->where('key', '=', 'project')->first();

        $headers = array(
            'Accept: application/json',
            'Content-Type: application/json'
        );

        $dom = new Dom();
        $dom->load($this->result->result);
        $name = $dom->find('a[data-toggle=collapse]');
        $items = $dom->find('li');
        $result = [];
        foreach($items as $item){
            $color = 'black';
            if(strpos($item->class, "alert-warning") !== false){
                $color = '#f79232';
            }elseif(strpos($item->class, "alert-danger") !== false){
                $color = '#d04437';
            }elseif(strpos($item->class, "alert-success") !== false){
                $color = '#14892c';
            }elseif(strpos($item->class, "alert-info") !== false){
                $color = '#59afe1';
            }

            $result[] = [
                'line' => $item->text,
                'color' => $color
            ];
        }

        $description = "{panel:title=Behat Output:".trim($name->text)."}";

        foreach($result as $k => $r){
            $description .= "{color:".$result[$k]['color']."}".$result[$k]['line']."{color}\n";
        }

        $description .= "{panel}\n{panel:title=Analysis}{panel}";
        $post = array(
            'fields' => array(
                'project' => array(
                    'key' => $project->value
                ),
                'summary' => 'Test Results: '. $this->test_id,
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

    }
}
