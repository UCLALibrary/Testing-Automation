#!/usr/bin/env python

import requests
import json

########################################
#
# Set up server url
#
########################################

url_base = "http://087cf198.ngrok.io/tests"
url_comments = "/comments/"
url_results = "/results/"

r = requests.get(url_base+url_results)
d = json.loads(r.text)

########################################
#
# Create dictionary for error messages
#
########################################

errors = {}
errors['Curl error thrown'] = 'Selenium server is down'

########################################
#
# Post messages to server
#
########################################

for p in d:
  id = p['id']
  result = p['result']
  parse_result = result.split('\n')
  print(id)
  for line in parse_result:
    for key, value in errors.iteritems():
      if key in line:
        report_error = requests.post(str(url_base)+url_comments+str(id), {'comment': value})
        print(report_error.text)

