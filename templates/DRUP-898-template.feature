Feature: Night Powell Hours
In order to find Night Powell Hours
As an anonymous user
I need to check that we can access the page from different paths

  Background:
    Given I go to "https://www.library.ucla.edu"

  Scenario: #1A
    Given I follow "[/powlib_link]"
    Then I should be on "[/powlib_url]"
    Then I follow "[/powell/np_link]"
    And I should be on "[/powell/np_url]"

  Scenario: #1B
    Given I follow "[/powlib_link]"
    Then I should be on "[/powlib_url]"
    And I follow "[/powell/location_link]"
    Then I should be on "[/powell/location_url]"

  Scenario: #1C
    Given I fill in "[/sitesearch_text]" with "night powell"
    And I click the "[/#submit_element]" element
    Then I should be on "[/sitesearch_res_url]"
    Then I follow "[/powell/np_link]"
    And I should be on "[/powell/np_url]"
    
