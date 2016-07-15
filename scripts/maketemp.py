#!/usr/bin/env python

# AUTHORS:
# Lilly An (Github: swamplilly)
# Ryan Gurnick

import fileinput, sys, csv
from sys import argv

########################################
#
# Error checking
#
########################################
input_count = len(argv)

if input_count != 3:
    print("ERROR: Missing feature file.\nPlease input your feature file as follows:\nmaketemp <NAME_OF_FEATURE_FILE>")
    sys.exit()

config = argv[1]
feature = argv[2]

csv_tag = ".csv"
template_tag = "-template.feature"
feature_tag = ".feature"

if not csv_tag in config:
    print("ERROR: Variables are not in csv format.\nIs variables.csv in the same directory?\nIf you are using another variable file, does it end with .csv?")
    sys.exit()

if template_tag in feature:
    print("ERROR: Input file is a template.\nPlease make sure your template file is named as: <NAME_OF_FILE>.feature, WITHOUT -template.feature")
    sys.exit()

if not feature_tag in feature:
    print("ERROR: Input file not detected as feature.\nDoes your file end with .feature?")



########################################
#
# Declare variables
#
########################################

#create -template.feature file
new_template = feature.replace(feature_tag, template_tag)
new_template_fd = open(new_template, "w+")

#store elements from config
config_fd = open(config, "r")
config_reader = csv.reader(config_fd)
config_dict = {}
for element in config_reader:
    if not element:
        continue
    key = '"%s"' % element[1]
    value = '[%s]' % element[0]
    config_dict[key] = value

#open feature file
feature_fd = open(feature, "rw")
feature_lines = [line.rstrip('\n') for line in feature_fd]

########################################
#
# Variable substitution
#
########################################

for line in feature_lines:
    this_line = line
    for this, with_this in config_dict.iteritems():
        if this in this_line:
            this_line = this_line.replace(this, with_this)
    new_template_fd.write(this_line + "\n")







