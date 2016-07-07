Feature: Information About Student Jobs at the Library
  In order to find information about student jobs at the library
  As an anonymous user
  I need to verify that the link is valid through different paths

Background:
  Given I go to [/home]

@homepage @footer @misc @employment
Scenario: #1A
  Given I follow [/employment_link]
  Then I should be on [/employment_url]
  Given I follow [/about/employment/studentpositions_link]
  Then I should be on [/support/apply_url]

@homepage @navbar @misc @employment
Scenario: #1B
  Given I follow [/support_link]
  Then I should be on [/support_url]
  Given I follow [/support/students_link]
  Then I should be on [/support/students_url]
  Given I follow [/support/apply_link]
  Then I should be on [/support/apply_url]

@search @topic @css @misc @employment
Scenario: #1C
  Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”student jobs”]
  And I click the [/submit_element] element
  Then I should be on [/sitesearchresult_query:”student jobs”]
  Given I follow [/sitesearchresult_link:”student jobs”]
  Then I should be on [/support/apply_url]
