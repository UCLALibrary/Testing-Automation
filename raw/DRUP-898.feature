Feature: Night Powell Hours
In order to find Night Powell Hours
As an anonymous user
I need to check that we can access the page from different paths

  Background:
    Given I go to "https://www.library.ucla.edu"

  Scenario: #1A
    Given I follow "Powell Library"
    Then I should be on "/powell"
    Then I follow "Night Powell"
    And I should be on "/destination/night-powell"

  Scenario: #1B
    Given I follow "Powell Library"
    Then I should be on "/powell"
    And I follow "At This Location"
    Then I should be on "/powell/at-this-location"

  Scenario: #1C
    Given I fill in "Site Search" with "night powell"
    And I click the "#submit" element
    Then I should be on "/site-search?search_query=night+powell+"
    Then I follow "Night Powell"
    And I should be on "/destination/night-powell"
    
