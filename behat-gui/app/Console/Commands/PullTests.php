<?php

namespace App\Console\Commands;

use App\Test;
use GitWrapper\GitWrapper;
use Illuminate\Console\Command;

class PullTests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'behat:pull';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pull tests from the specified github repo.';

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
        $directory = base_path().'/storage/app/tmp/git';

        exec('rm -rf '.$directory);
        $git = new GitWrapper();
        $git->cloneRepository(config('gitpull.git_repo'), $directory);
        $scan = scandir($directory);

        #unset all of the .. . .git files
        unset($scan[0], $scan[1], $scan[2]);

        foreach($scan as $item){
            sleep(1);
            $name = md5(time()).".feature.template";
            $current_file = file_get_contents($directory.'/'.$item);
            file_put_contents(base_path().'/features/'.$name, $current_file);

            $test = new Test();
            $test->name = explode('.',$item)[0];
            $test->location = base_path().'/features/'.$name;
            $test->save();

            unlink($directory.'/'.$item);
        }
    }
}
