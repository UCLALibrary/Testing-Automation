<?php

namespace App\Jobs;

use App\Jobs\Job;
use App\Notifications;
use App\Test;
use App\TestResult;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class FriendlyMessages extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    protected $errors;
    protected $errors_expression;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->errors['Curl error thrown'] = "Selenium server is down.";
        $this->errors['PHP Fatal error:'] = "Check Feature Context tab for corresponding function to this Gherkin line.";
        $this->errors['alert-warning'] = "Typo?";
        $this->errors['Could not open connection: The path to the driver executable must be set by the phantomjs.binary.path capability/system property/PATH variable; for more information, see https://github.com/ariya/phantomjs/wiki. The latest version can be downloaded from http://phantomjs.org/download.html'] = "Remove the @javascript tag from this scenaria. This tag is not compatible with PhantomJS.";

        $this->errors_expression['/(Current page is "([\/a-z0-9-&=+]+)", but "([\/a-z0-9-&=+]+)" expected.)/'] = "Url is incorrect.\nVariable or Variable set may be incorrect.\nDid javascript open new window? -> Use Gherkin line \"Then I switch to the next window\"\nAre there two links on this page with the exact same text name?\nAre you on the website you\'re trying to test on?";
        $this->errors_expression['/\(Link with id\|title\|alt\|text "([a-zA-Z0-9!@#$%^&*()_\-+=?.<,`~\\\]\{\}\[|>\/]+)" not found\.\)/'] = "No button or link on that page that matches this text.";
        $this->errors_expression['/cURL error 6: Couldn\'t resolve host \'(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?\'/'] = "Is website server down?\nIncorrect url.";
        $this->errors_expression['/No html element found for the selector \(\'([.#0-9a-zA-Z-_]+)\'\)\)/'] = "CSS identifier (class, id, or tag) is incorrect.";
        $this->errors_expression['/Form field with id\|name\|label\|value\|placeholder "([a-zA-Z0-9#._\- ]+)" not found./'] = "This element is not on this page.\nAre you on the correct tag? Use Gherkin line \"Then I switch to the next window\"\nDid the page load fully? Try Gherkin line \"Then wait <NUMBER> second\" where <NUMBER> is time to pause in seconds (suggestion 2 or 3).";
        $this->errors_expression['/\(Expected selector, but <([a-zA-Z0-9!@#$%^&*_\-+=?., \"|>\/]+)> found./'] = "CSS selector is not correct. Go to this element on the website, right-click > Inspect Element ";

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $return = '';

        $results = TestResult::where('comment_complete', '=', 0)->get();
        foreach($results as $r){
            $res = $r->result;
            foreach($this->errors as $k => $v) {
                if (strpos($res, $k) !== false){
                    $return .= $v;
                }
            }
            foreach($this->errors_expression as $k => $v){
                preg_match($k, $res, $matches);
                if(!empty($matches)){
                    $return .= $v;
                }
            }
            if($return != null) {
                $r->comment = $return;
            }else{
                $r->comment = null;
            }
            $r->comment_complete = 1;
            $r->save();

            Notifications::firstOrCreate(['message' => Test::where('id', $r->test_id)->withTrashed()->first()->name.' was analyzed']);
        }
    }
}
