#!/usr/bin/env python
import fileinput
from sys import argv

config=argv[1]
feature=argv[2]
new_feature=feature.replace(".feature", "-template.feature")
config_file = open(config, "r")
feature_file = open(feature, "rw")
new_feature_file = open(new_feature, "w+")

lines = [line.rstrip('\n') for line in config_file]
tags = {}

for line in lines:
  if not line:
    continue
  entries = line.split(",")
  key = '"%s"' % entries[1]
  value = '[%s]' % entries[0]
  tags[key] = value

replace_me = [line.rstrip('\n') for line in feature_file]

for line in replace_me:
  this_line = line
  for key, value in tags.iteritems():
    if key in this_line:
      this_line = this_line.replace(key, value)
  new_feature_file.write(this_line + "\n")
