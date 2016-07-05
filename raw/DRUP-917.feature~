Feature: Find Library Hours
    Background:
    Given I go to "http://library.ucla.edu"

    Scenario: 1A
    Then I follow "Hours"
    Then the url should match "/hours"

    Scenario: 1B
    Then I fill in "Site Search" with "hours"
    Then I click the "#submit" element
    Then the url should match "/site-search"
    Then I follow "Hours"
    Then the url should match "/hours"