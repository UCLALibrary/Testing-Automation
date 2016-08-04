<?php

////////////////////////////////////////////////////////////////////////////////
//
// ERROR CHECKING
//
////////////////////////////////////////////////////////////////////////////////

if (count($argv) != 3) {
    exit("ERROR: Missing feature file or config file.\n* Please execute commands as follows: php maketemp <CONFIG_FILE> <FEATURE_FILE>\n");
}

$config = $argv[1];
$feature = $argv[2];

$csv_tag = ".csv";
$template_tag = "-template.feature";
$feature_tag = ".feature";

if (strpos($config, $csv_tag) === false) {
    exit("ERROR: Variables are not in csv format.\n* Is variables.csv in the same directory?\n* If you are using another variable file, does it end with .csv?\n");
}

if (strpos($feature, $template_tag) !== false) {
    exit("ERROR: Input file is a template.\n* Please make sure your template file is named as: <NAME_OF_FILE>.feature, WITHOUT -template.feature\n");
}

if (strpos($feature, $feature_tag) === false) {
    exit("ERROR: Input file not detected as feature.\n* Does your file end with .feature?\n");
}

////////////////////////////////////////////////////////////////////////////////
//
// DECLARE VARIABLES
// OPEN FILES
//
////////////////////////////////////////////////////////////////////////////////

// create -template.feature file
$new_template = str_replace($feature_tag, $template_tag, $feature);
$new_template_fd = fopen($new_template, "w+");

// store elements from config
$config_dict = array_map('str_getcsv', file($config));

//read feature file
$feature_lines = file($feature, FILE_IGNORE_NEW_LINES);

////////////////////////////////////////////////////////////////////////////////
//
// VARIABLE SUBSTITUTION
//
////////////////////////////////////////////////////////////////////////////////

foreach($feature_lines as $line) {
    $this_line = $line . "\n";
    foreach($config_dict as $def) {
        $key = "[" . $def[0] . "]";
        $val = "\"" . $def[1] . "\"";

        if (strpos($this_line, $val) !== false) {
            $this_line = str_replace($val, $key, $line) . "\n";
        }
    }
    fwrite($new_template_fd, $this_line);
}

?>