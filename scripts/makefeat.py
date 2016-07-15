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
    print("ERROR: Missing template file.\nPlease input your template file as follows:\nmakefeat <NAME_OF_TEMPLATE_FILE>")
    sys.exit()

config = argv[1]
template = argv[2]

csv_tag = ".csv"
template_tag = "-template.feature"
feature_tag = ".feature"

if not csv_tag in config:
    print("ERROR: Variables are not in csv format.\nIs variables.csv in the same directory?\nIf you are using another variable file, does it end with .csv?")
    sys.exit()

if not template_tag in template:
    print("ERROR: Input file is not tagged as template.\nPlease make sure your template file is named as: <NAME_OF_FILE>-template.feature")
    sys.exit()



########################################
#
# Declare variables
#
########################################

#create .feature file
new_feature = template.replace(template_tag, feature_tag)
new_feature_fd = open(new_feature, "w+")

#store elements from config
config_fd = open(config, "r")
config_reader = csv.reader(config_fd)
config_dict = {}
for element in config_reader:
    if not element:
        continue
    key = '[%s]' % element[0]
    value = '"%s"' % element[1]
    config_dict[key] = value

#open template file
template_fd = open(template, "rw")
template_lines = [line.rstrip('\n') for line in template_fd]



########################################
#
# Variable substitution
#
########################################

for line in template_lines:
    this_line = line
    for this, with_this in config_dict.iteritems():
        if this in this_line:
            this_line = this_line.replace(this, with_this)
    new_feature_fd.write(this_line + "\n")



