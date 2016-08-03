<?php

$file = $argv[1];

$file_csv = array_map('str_getcsv', file($file));

$count = count($file_csv);

for ($i = 0; $i < $count; $i++) {
    for ($k = $i + 1; $k < $count; $k++) {
        if ($file_csv[$i][0] == $file_csv[$k][0]) {
            print("DUP KEY FOUND:\n");
            print("Item $i KEY: " . $file_csv[$i][0] . "\nVALUE: " . $file_csv[$i][1] . "\n");
            print("Item $k KEY: " . $file_csv[$k][0] . "\nVALUE: " . $file_csv[$k][1] . "\n");
            print("\n");
        }
    }
}

?>
