Feature: Find Library Hours
    Background:
    Given I go to [/home]

    Scenario: 1A
    Then I follow [/hours_link]
    Then the url should match [/hours_url]

    Scenario: 1B
    Then I fill in [/sitesearch_text] with [/sitesearchresult_search:”hours”]
    Then I click the [/submit_element] element
    Then the url should match [/sitesearch_url]
    Then I follow [/hours_link]
    Then the url should match [/hours_url]
