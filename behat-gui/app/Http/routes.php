<?php
use \Behat\Gherkin\Keywords\ArrayKeywords;
use \Behat\Gherkin\Lexer;
use \Behat\Gherkin\Parser;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource("tests","TestController");
Route::get('/tests/execute/{tests}', ['as' => 'tests.execute', 'uses' => 'TestController@execute']);
Route::resource("variables","VariableController");

Route::get('/testing', function(){

    $test = 6;
    $t = \App\Test::where('id', '=', $test)->first();
    $file = file_get_contents($t->location);
    $file = str_replace(" ", " ", $file);

    $s = "/\[([a-zA-Z\/_]+)\]/";
    preg_match_all($s, $file, $match);
    foreach($match[1] as $m) {
        $file = str_replace("[" . $m . "]", \App\Variable::where('key', '=', $m)->first()->value, $file);
    }

    $data = $file;

    $name = explode('.', $t->location)[0];

    $keywords = new ArrayKeywords([
        'en' => array(
            'feature'          => 'Feature',
            'background'       => 'Background',
            'scenario'         => 'Scenario',
            'scenario_outline' => 'Scenario Outline|Scenario Template',
            'examples'         => 'Examples|Scenarios',
            'given'            => 'Given',
            'when'             => 'When',
            'then'             => 'Then',
            'and'              => 'And',
            'but'              => 'But'
        )
    ]);

    $lexer = new Lexer($keywords);
    $parser = new Parser($lexer);

    $info = $parser->parse($data);
    $file = '# language: '. $info->getLanguage();

    foreach($info->getTags() as $t){
        $file .= "\n@". $t;
    }

    $file .= "\nFeature: ". $info->getTitle();
    foreach(explode("\n", $info->getDescription()) as $d){
        $file .= "\n  ". trim($d);
    }

    if($info->getBackground() !== null) {
        $background = $info->getBackground();
        $file .= "\n\n  " . $background->getKeyword() . ": ";
        if ($background->getTitle() != null) {
            $file .= $background->getTitle();
        }

        foreach ($background->getSteps() as $step) {
            $file .= "\n    " . trim($step->getKeyword()) . " " . trim($step->getText());
        }
    }


    $file .= "\n";
    foreach($info->getScenarios() as $s){
        foreach($s->getTags() as $t){
            $file .= "\n  @". $t;
        }
        $file .= "\n  ".$s->getKeyword(). ": ";
        foreach(explode("\n", $s->getTitle()) as $k => $t){
            if($k == 0){
                $file .= trim($t);
            }else{
                $file .= "\n    " . trim($t);
            }
        }
        foreach($s->getSteps() as $step){

            $string = $step->getKeyword(). " ". $step->getText();
            $file .= "\n    ".$string;
        }


    }

    $f = fopen($name.".feature", "w");
    fwrite($f, $file);
    fclose($f);

});