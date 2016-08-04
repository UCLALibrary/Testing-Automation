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
$template = $argv[2];

$csv_tag = ".csv";
$template_tag = "-template.feature";
$feature_tag = ".feature";

if (strpos($config, $csv_tag) === false) {
    exit("ERROR: Variables are not in csv format.\n* Is variables.csv in the same directory?\n* If you are using another variable file, does it end with .csv?\n");
}

if (strpos($template, $template_tag) === false) {
    exit("ERROR: Input file is a template.\n* Please make sure your template file is named as: <NAME_OF_FILE>.feature, WITHOUT -template.feature\n");
}

////////////////////////////////////////////////////////////////////////////////
//
// DECLARE VARIABLES
// OPEN FILES
//
////////////////////////////////////////////////////////////////////////////////

// create -template.feature file
$new_feature = str_replace($template_tag, $feature_tag, $template);
$new_feature_fd = fopen($new_feature, "w+");

// store elements from config
$config_dict = array_map('str_getcsv', file($config));

//read feature file
$template_lines = file($template, FILE_IGNORE_NEW_LINES);

////////////////////////////////////////////////////////////////////////////////
//
// VARIABLE SUBSTITUTION
//
////////////////////////////////////////////////////////////////////////////////

foreach($template_lines as $line) {
    $this_line = $line . "\n";
    foreach($config_dict as $def) {
        $key = "[" . $def[0] . "]";
        $val = "\"" . $def[1] . "\"";

        if (strpos($this_line, $key) !== false) {
            $this_line = str_replace($key, $val, $line) . "\n";
        }
    }
    fwrite($new_feature_fd, $this_line);
}

?>