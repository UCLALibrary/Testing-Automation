Feature: Getting Information About the Libraries
  In order to get information about all libraries
  As an anonymous user
  I should check that these links are valid from all paths

  Background:
    Given I go to [/home]

    Scenario: #1A
      Given I follow [/artlib_link]
      Then I should be on [/artlib_url]

    Scenario: #1B
      Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”arts library”]
      And I click the [/submit_element] element
      Then I should be on [/sitesearchresult_query:”arts library”]
      Given I follow [/artlib_link]
      Then I should be on [/artlib_url]

    Scenario: #1C
      Given I follow [/locations_link]
      Then I should be on [/equip_link]
      Given I follow [/artlib_link]
      Then I should be on [/artlib_url]

    Scenario: #1D
      Given I follow [/hours_link]
      Then I should be on [/hours_url]
      Given I follow [/artlib_link]
      Then I should be on [/artlib_url]

    Scenario: #1E
      Given I follow [/biolib_link]
      Then I should be on [/biolib_url]

    Scenario: #1F
      Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”biomed”]
      And I click the [/submit_element] element
      Then I should be on [/sitesearchresult_query:”biomed”]
      Given I follow [/biolib_link]
      Then I should be on [/biolib_url]

    Scenario:  #1G
      Given I follow [/locations_link]
      Then I should be on [/equip_link]
      Given I follow [/biolib_link]
      Then I should be on [/biolib_url]

    Scenario: #1H
      Given I follow [/hours_link]
      Then I should be on [/hours_url]
      Given I follow [/biolib_link]
      Then I should be on [/biolib_url]

    Scenario: #1I
      Given I follow [/powlib_link]
      Then I should be on [/powlib_url]

    Scenario: #1J
      Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”powell”]
      And I click the [/submit_element] element
      Then I should be on [/sitesearchresult_query:”powell”]
      Given I follow [/powlib_link]
      Then I should be on [/powlib_url]

    Scenario: #1K
      Given I follow [/locations_link]
      Then I should be on [/equip_link]
      Given I follow [/powlib_link]
      Then I should be on [/powlib_url]

    Scenario: #1L
      Given I follow [/locations_link]
      Then I should be on [/equip_link]
      Given I fill in "" with [/locationssearchresult_search:”powell library”]
      And I click the [/locationssearch_element] element
      Then I should be on [/locationssearchresult_query:”powell library”]
      Given I follow [/powlib_link]
      Then I should be on [/powlib_url]

    Scenario: #1M
      Given I follow [/hours_link]
      Then I should be on [/hours_url]
      Given I follow [/powlib_link]
      Then I should be on [/powlib_url]

    Scenario: #1N
      Given I follow [/reslib_link]
      Then I should be on [/reslib_url]

    Scenario: #1O
      Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”yrl”]
      And I click the [/submit_element] element
      Then I should be on [/sitesearchresult_query:”yrl”]
      Given I follow [/reslib_link]
      Then I should be on [/reslib_url]

    Scenario: #1P
      Given I follow [/locations_link]
      Then I should be on [/equip_link]
      Given I follow [/reslib_link]
      Then I should be on [/reslib_url]

     Scenario: #1Q
       Given I follow [/locations_link]
       Then I should be on [/equip_link]
       Given I fill in "" with [/sitesearchresult_search:”yrl”]
       Then I should be on [/locationssearchresult_result:”yrl”]
       Given I follow [/reslib_link]
       Then I should be on [/reslib_url]

     Scenario: #1R
       Given I follow [/hours_link]
       Then I should be on [/hours_url]
       Given I follow [/reslib_link]
       Then I should be on [/reslib_url]

     Scenario: #1S
       Given I follow [/muslib_link]
       Then I should be on [/muslib_url]

     Scenario: #1T
       Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”music library”]
       And I click the [/submit_element] element
       Then I should be on [/sitesearchresult_query:”music library”]
       Given I follow [/muslib_link]
       Then I should be on [/muslib_url]

     Scenario: #1U
       Given I follow [/locations_link]
       Then I should be on [/equip_link]
       Given I follow [/locations/librariesonly_link]
       Then I should be on [/locations/librariesonly_url]
       Given I follow [/muslib_link]
       Then I should be on [/muslib_url]

     Scenario: #1V
       Given I follow [/locations_link]
       Then I should be on [/equip_link]
       Given I fill in "" with [/sitesearchresult_search:”music library”]
       And I click the [/locationssearch_element] element
       Then I should be on [/locationssearchresult_query:”music library”]
       Given I follow [/muslib_link]
       Then I should be on [/muslib_url]

     Scenario: #1W
       Given I follow [/hours_link]
       Then I should be on [/hours_url]
       Given I follow [/muslib_link]
       Then I should be on [/muslib_url]

     Scenario: #1X
       Given I follow [/selib_link]
       Then I should be on [/selib_url]

     Scenario: #1Y
       Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”boelter library”]
       And I click the [/submit_element] element
       Then I should be on [/sitesearchresult_query:”boelter library”]
       Given I follow [/selib_link]
       Then I should be on [/selib_url]

     Scenario: #1Z
       Given I follow [/locations_link]
       Then I should be on [/equip_link]
       Given I follow [/selib_link]
       Then I should be on [/selib_url]

     Scenario: #2A
       Given I follow [/locations_link]
       Then I should be on [/equip_link]
       Given I fill in "" with [/sitesearchresult_search:”boelter library”]
       And I click the [/locationssearch_element] element
       Then I should be on [/locationssearchresult_query:”boelter library”]
       Given I follow [/selib_link]
       Then I should be on [/selib_url]

     Scenario: #2B
       Given I follow [/hours_link]
       Then I should be on [/hours_url]
       Given I follow [/selib_link]
       Then I should be on [/selib_url]

     Scenario: #2C
       Given I follow [/lawlib]
       Then I should be on [/lawlib_url]

     Scenario: #2D
       Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”law library”]
       And I click the [/submit_element] element
       Then I should be on [/sitesearchresult_query:”law library”]
       Given I follow [/lawlib]
       Then I should be on [/lawlib_url]

     Scenario: #2E
       Given I follow [/locations_link]
       Then I should be on [/equip_link]
       Given I follow [/lawlib]
       Then I should be on [/lawlib_url]

     Scenario: #2F
       Given I follow [/locations_link]
       Then I should be on [/equip_link]
       Given I fill in "" with [/sitesearchresult_search:”law library”]
       And I click the [/locationssearch_element] element
       Then I should be on [/locationssearchresult_query:”law library”]

     Scenario: #2G
       Given I follow [/hours_link]
       Then I should be on [/hours_url]
       Given I follow [/lawlib]
       Then I should be on [/lawlib_url]
