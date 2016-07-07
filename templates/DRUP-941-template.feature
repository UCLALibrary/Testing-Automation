Feature: Accessing Journals
  In order to access journals
  As an anonymous user
  I need to verify that these links work from different paths

  Background:
    Given I go to [/home]

    @javascript @homepage @sidebar @multiwindow
    Scenario: #1A
      Given I follow [/sitesearchresult_search:”Journals”]
      Then I should be on [/journals_url]
      Then I follow [/#journals/azjournals_link]
      Then I switch to the next window
      And wait 2 second
      Then I should be on [/#journals/azjournals_url]

    @homepage @navbar @search
    Scenario: #1B
      Given I follow [/search_link]
      Then I should be on [/search_url]
      Then I follow [/search/findejournals_link]
      Then I should be on [/search/findejournals_url]

    @search @css @topic @page
    Scenario: #1C
      Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”Journals”]
      And I click the [/submit_element] element
      Then I should be on [/sitesearchresult_query:”Journals”]
      Then I follow [/sitesearchresult_link:”Journals”]
      Then I should be on [/locations/journalarticlesconference_url]
      Then I follow [/locations/journalarticlesconference/scieen_link]
      Then I should be on [/locations/journalarticlesconference/scieen_url]
      Then I follow [/locations/journalarticlesconference/scieen/title_link]
      Then I should be on [/locations/journalarticlesconference/scieen/title_url]
