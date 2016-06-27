Feature: Biomedica Library Key Resources
  In order to find Biomedical Library Key Resources on the library website
  As an anonymous user
  I need to verify that these links work on various paths

  Background:
    Given I go to [/home]

    Scenario: #1A
      Given I follow [/biolib_link]
      Then I should be on [/biolib_url]
      Given I follow [/biomed/keyresources_link]
      Then I should be on [/biomed/keyresources_url]

    Scenario: #1B
      Given I follow [/locations_link]
      Then I should be on [/equip_link]
      Given I follow [/biolib_link]
      Then I should be on [/biolib_url]
      Given I follow [/biomed/keyresources_link]
      Then I should be on [/biomed/keyresources_url]

    Scenario: #1C
      Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”Biomedical Library Key Resources”]
      And I click the [/submit_element] element
      Then I should be on [/sitesearchresult_query:”Biomedical Library Key Resources”]
      Given I follow [/biomed/keyresources_link]
      Then I should be on [/biomed/keyresources_url]
