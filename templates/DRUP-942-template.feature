Feature: Accessing Databases
  In order to access databases
  As an anonymous user
  I need to verify that these links work from different paths

  Background:
    Given I go to [/home]

#    @javascript
#    Scenario: #1A
#      Then I follow [/database_link]
#      Then I should be on [/database_url]
#      Then I fill in [/#database/search_text] with [/#database/search_search:”PsycINFO”]
#      Then I click the [/#database/search_submit] element
#      Then I should be on [/#database/search_query:”PsycINFO”]
#      Then I follow [/#database/search_search:”PsycINFO”]
#      Then I switch to the next window
#      Then I should be on [/psycinfo]

    @javascript
    Scenario: #1B
      Then I follow [/database_link]
      Then I should be on [/database_url]
      Then I fill in [/#database/search_text] with [/#database/search_search:”PsycINFO”]
      Then I click the [/#database/search_submit] element
      Then I should be on [/#database/search_query:”PsycINFO”]
      Then I follow [/#database/search_search:”PsycINFO”]
      Then I switch to the next window
      Then I should be on [/psycinfo]

    @javascript
    Scenario: #1C
      Then I follow [/database_link]
      Then I should be on [/database_url]
      Then I follow [/#database/az_link]
      Then I should be on [/#database/az_url]
      Then I follow [/azsearch_search:”P”]
      Then I should be on [/azsearch_query:”P”]
      Then I fill in [/azsearch_text] with [/#database/search_search:”PsycINFO”]
      Then I click the [/azsearch_submit] element
      Then I should be on [/azsearch_query:”PsycINFO”]
      Then wait 2 second
      Then I follow [/#database/search_search:”PsycINFO”]
      Then wait 2 second
      Then I switch to the next window
      Then wait 2 second
      Then I should be on [/psycinfo]

    @javascript
    Scenario: #1D
      Then I follow [/database_link]
      Then I should be on [/database_url]
      Then I follow [/#database/databasesbysubject_link]
      Then I should be on [/#database/databasesbysubject_url]
      Then I fill in [/#database/databasesbysubject/search_text] with [/#database/search_search:”PsycINFO”]
      Then I click the [/#database/databasesbysubject/search_submit] element
      Then I switch to the next window
      Then I should be on [/#database/search_query:”PsycINFO”]
      Then I follow [/#database/search_search:”PsycINFO”]
      Then I switch to the next window
      Then I should be on [/psycinfo]

    Scenario: #1E
      Then I follow [/search_link]
      Then I should be on [/search_url]
      Then I follow [/search/browsedatabasesbysubject_link]
      Then I should be on [/#database/databasesbysubject_url]

    @javascript
    Scenario: #1F
      Then I follow [/search_link]
      Then I should be on [/search_url]
      Then I follow [/search/finddatabasebytitle_link]
      Then I should be on [/#database/az_url]
      Then I fill in [/azsearch_text] with [/#database/search_search:”PsycINFO”]
      Then I click the [/azsearch_submit] element
      Then wait 2 second
      Then I follow [/#database/search_search:”PsycINFO”]
      Then I switch to the next window
      Then I should be on [/psycinfo]

    @javascript
    Scenario: #1G
      Then I follow [/search_link]
      Then I should be on [/search_url]
      Then I follow [/#database/az_link]
      Then I switch to the next window
      Then I should be on [/#database/az_url]
      Then I fill in [/azsearch_text] with [/#database/search_search:”PsycINFO”]
      Then I click the [/azsearch_submit] element
      Then wait 2 second
      Then I follow [/#database/search_search:”PsycINFO”]
      Then I switch to the next window
      Then I should be on [/psycinfo]
