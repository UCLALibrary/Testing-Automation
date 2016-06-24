#!/bin/py
import fileinput
from sys import argv

config=argv[1]
feature=argv[2]
new_feature=feature.replace(".feature", "-template.feature")
config_file = open(config, "r")
feature_file = open(feature, "r")
new_feature_file = open(new_feature, "w+")

lines = [line.rstrip('\n') for line in config_file]
tags = {}

for line in lines:
  if not line:
    continue
  entries = line.split(" = ")
  key = '"%s"' % entries[1]
  value = '"%s"' % entries[0]
  tags[key] = value

replace_me = [line.rstrip('\n') for line in feature_file]

for line in replace_me:
  replace = False
  for key, value in tags.iteritems():
    if key in line:
      new_feature_file.write(line.replace(key, value))
      replace = True
      break
  if replace == False:
    new_feature_file.write(line)
  new_feature_file.write("\n")
