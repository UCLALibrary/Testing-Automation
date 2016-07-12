#!/usr/bin/env python

# AUTHORS:
# Lilly An (Github: swamplilly)
# Ryan Gurnick

import requests
import json
import re

########################################
#
# Set up server url
#
########################################

url_base = "http://087cf198.ngrok.io/tests/"
url_comments = "comments/"
url_results = "results/"

r = requests.get(url_base+url_results)
d = json.loads(r.text)

########################################
#
# Create dictionaries for error messages
#
########################################

#regular text dictionary
errors = {}
errors['Curl error thrown'] = 'Selenium server is down.'
errors['PHP Fatal error:'] = 'Check Feature Context tab for corresponding function to this Gherkin line.'
errors['alert-warning'] = 'Typo?'
errors['Could not open connection: The path to the driver executable must be set by the phantomjs.binary.path capability/system property/PATH variable; for more information, see https://github.com/ariya/phantomjs/wiki. The latest version can be downloaded from http://phantomjs.org/download.html'] = 'Remove the @javascript tag from this scenaria. This tag is not compatible with PhantomJS.'

#regex dictionary
errors_expression = {}
errors_expression['(Current page is "([/a-z0-9-&=+]+)", but "([/a-z0-9-&=+]+)" expected.)'] = 'Url is incorrect.\nVariable or Variable set may be incorrect.\nDid javascript open new window? -> Use Gherkin line "Then I switch to the next window"\nAre there two links on this page with the exact same text name?\nAre you on the website you\'re trying to test on?'
errors_expression['\(Link with id\|title\|alt\|text "([a-zA-Z0-9!@#$%^&*()_\-+=?.<,`~\\\]\{\}\[|>/]+)" not found\.\)'] = 'No button or link on that page that matches this text.'
errors_expression['cURL error 6: Couldn\'t resolve host \'(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?\''] = 'Is website server down?\nIncorrect url.'
errors_expression['No html element found for the selector \(\'([.#0-9a-zA-Z-_]+)\'\)\)'] = 'CSS identifier (class, id, or tag) is incorrect.'
errors_expression['Form field with id\|name\|label\|value\|placeholder "([a-zA-Z0-9#._\- ]+)" not found.'] = 'This element is not on this page.\nAre you on the correct tag? Use Gherkin line "Then I switch to the next window"\nDid the page load fully? Try Gherkin line "Then wait <NUMBER> second" where <NUMBER> is time to pause in seconds (suggestion 2 or 3).'
errors_expression['\(Expected selector, but <([a-zA-Z0-9!@#$%^&*_\-+=?., \"|>/]+)> found.'] = 'CSS selector is not correct. Go to this element on the website, right-click > Inspect Element '


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
    #check in regular text dictionary
    for key, value in errors.iteritems():
      if key in line:
        report_error = requests.post(str(url_base)+url_comments+str(id), {'comment': value})
        print(report_error.text)
    #check in regex dictionary
    for key, value in errors_expression.iteritems():
      pattern = re.compile(key)
      if re.search(pattern, line) != None:
        report_error = requests.post(str(url_base)+url_comments+str(id), {'comment': value})

