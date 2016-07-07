Feature: Course Reserve
In order to find Course Reserves on the library site
As an anonymous user
I need to check that we can access the page from different paths

  Background:
    Given I go to [/home]

  @homepage @navbar @misc @cr
  Scenario: #1A
    #Given I follow [/sitesearchresult_search:”Journals”]
    Given I follow [/#journals/searchcoursereserves_link]
    Then I should be on [/#journals/searchcoursereserves_url]

  @search @homepage @navbar @misc @cr @renew
  Scenario: #1B
    Given I follow [/search_link]
    Then I should be on [/search_url]
    Given I follow [/search/coursereserves_link]
    Then I should be on "use/borrow-renew-return/course-reserves"
    Given I follow [/#journals/searchcoursereserves_link]
    Then I should be on [/#journals/searchcoursereserves_url]

  @homepage @navbar @search @misc @cr
  Scenario: #1C
    Given I follow [/search_link]
    Then I should be on [/search_url]
    Given I follow [/search/coursereserves_link]
    Then I should be on [/search/coursereserves_url]
    Given I follow [/search/searchcoursereservestab_link]
    Then I should be on [/#journals/searchcoursereserves_url]

  @homepage @navbar @misc @renew @cr
  Scenario: #1D
    Given I follow [/support_link]
    Then I should be on [/support_url]
    Given I follow [/support/students_link]
    Then I should be on [/support/students_url]
    Given I follow [/support/coursematerialsreserve_link]
    Then I should be on [/search/coursereserves_url]
    Given I follow [/#journals/searchcoursereserves_link]
    Then I should be on [/#journals/searchcoursereserves_url]

  @homepage @navbar @misc @renew @cr
  Scenario: #1E
    Given I follow [/support_link]
    Then I should be on [/support_url]
    Given I follow [/support/coursematerialsreserve_link]
    Then I should be on [/search/coursereserves_url]
    Given I follow [/#journals/searchcoursereserves_link]
    Then I should be on [/#journals/searchcoursereserves_url]

  @homepage @navbar @cr @renew @misc
  Scenario: #1F
    Given I follow [/support_link]
    Then I should be on [/support_url]
    Given I follow [/search/coursereserves_link]
    Then I should be on [/search/coursereserves_url]
    Given I follow [/#journals/searchcoursereserves_link]
    Then I should be on [/#journals/searchcoursereserves_url]


  @search @css @page @cr @misc @renew
  Scenario: #1G
    Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”course reserves”]
    And I click the [/submit_element] element
    Then I should be on [/sitesearchresult_query:”course reserves”]
    Given I follow [/search/coursereserves_link]
    Then I should be on [/search/coursereserves_url]
    Given I follow [/#journals/searchcoursereserves_link]
    Then I should be on [/#journals/searchcoursereserves_url]

  @search @css @misc @cr @renew @locations @powell
  Scenario: #1H
    Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”course reserves”]
    And I click the [/submit_element] element
    Then I should be on [/sitesearchresult_query:”course reserves”]
    Given I click the [/sitesearchresult_link:”course reserves”] element
    Then I should be on [/sitesearchresult_url:”course reserves”]
    Given I follow [/search/coursereserves_link]
    Then I should be on [/search/coursereserves_url]
    Given I follow [/search/coursereserves_link]
    Then I should be on [/#journals/searchcoursereserves_url]

  @locations @arts @misc @cr @renew
  Scenario: #1I
    Given I follow [/artlib_link]
    Then I should be on [/artlib_url]
    Given I follow [/search/coursereserves_link]
    Then I should be on [/search/coursereserves_url]
    Given I follow [/#journals/searchcoursereserves_link]
    Then I should be on [/#journals/searchcoursereserves_url]

  @locations @arts @misc @cr
  Scenario: #1J
    Given I follow [/artlib_link]
    Then I should be on [/artlib_url]
    Given I follow [/arts/collections_link]
    Then I should be on "arts/collections"
    Given I follow [/search/coursereserves_link]
    Then I should be on [/search/coursereserves_url]
    Given I follow [/#journals/searchcoursereserves_link]
    Then I should be on [/#journals/searchcoursereserves_url]

  @locations @powell @cr @misc
  Scenario: #1K
    Given I follow [/powlib_link]
    Then I should be on [/powlib_url]
    Given I follow [/#journals/searchcoursereserves_link]
    Then I should be on [/#journals/searchcoursereserves_url]

  @locations @powell @cr @misc @renew
  Scenario: #1L
    Given I follow [/powlib_link]
    Then I should be on [/powlib_url]
    Given I follow [/arts/collections_link]
    Then I should be on "/powell/collections"
    Given I follow [/search/coursereserves_link]
    Then I should be on [/search/coursereserves_url]
    Given I follow [/#journals/searchcoursereserves_link]
    Then I should be on [/#journals/searchcoursereserves_url]

  @locations @sel @misc @cr
  Scenario: #1M
    Given I follow [/selib_link]
    Then I should be on [/selib_url]
    Given I follow [/#journals/searchcoursereserves_link]
    Then I should be on [/#journals/searchcoursereserves_url]
