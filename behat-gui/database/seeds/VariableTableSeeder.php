<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class VariableTableSeeder extends Seeder {

    public function run()
    {
        $file = file_get_contents(base_path().'/database/seeds/variables.csv');
        $lines = explode("\n", $file);
        foreach($lines as $l) {
            $line = explode(",", $l);
            DB::table('variables')->insert([
                'key' => $line[0],
                'value' => json_encode([
                    str_replace("\\", "", implode(",", array_splice($line, 1)))
                ]),
                'sets' => json_encode([
                    0
                ])
            ]);
        }
    }

}