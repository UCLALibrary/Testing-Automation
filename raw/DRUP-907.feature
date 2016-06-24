Feature: Course Reserve
In order to find Course Reserves on the library site
As an anonymous user
I need to check that we can access the page from different paths

  Background:
    Given I go to "https://www.library.ucla.edu"

  Scenario: #1A
    #Given I follow "Journals"
    Given I follow "Search Course Reserves"
    Then I should be on "/vwebv/enterCourseReserve.do"

  Scenario: #1B
    Given I follow "Search"
    Then I should be on "/search"
    Given I follow "Course Reserves"
    Then I should be on "use/borrow-renew-return/course-reserves"
    Given I follow "Search Course Reserves"
    Then I should be on "/vwebv/enterCourseReserve.do"

  Scenario: #1C
    Given I follow "Search"
    Then I should be on "/search"
    Given I follow "Course Reserves"
    Then I should be on "/use/borrow-renew-return/course-reserves"
    Given I follow "UCLA Library Catalog Course Reserves Tab"
    Then I should be on "/vwebv/enterCourseReserve.do"

  Scenario: #1D
    Given I follow "Research & Teaching Support"
    Then I should be on "/support"
    Given I follow "Support for Students"
    Then I should be on "/support/students"
    Given I follow "Get Course Materials on Reserve"
    Then I should be on "/use/borrow-renew-return/course-reserves"
    Given I follow "Search Course Reserves"
    Then I should be on "/vwebv/enterCourseReserve.do"

  Scenario: #1E
    Given I follow "Research & Teaching Support"
    Then I should be on "/support"
    Given I follow "Get Course Materials on Reserve"
    Then I should be on "/use/borrow-renew-return/course-reserves"
    Given I follow "Search Course Reserves"
    Then I should be on "/vwebv/enterCourseReserve.do"

  Scenario: #1F
    Given I follow "Research & Teaching Support"
    Then I should be on "/support"
    Given I follow "Course Reserves"
    Then I should be on "/use/borrow-renew-return/course-reserves"
    Given I follow "Search Course Reserves"
    Then I should be on "/vwebv/enterCourseReserve.do"

  Scenario: #1G
    Given I fill in "Site Search" with "course reserves"
    And I click the "#submit" element
    Then I should be on "/site-search?search_query=Course+reserve"
    Given I follow "Course Reserves"
    Then I should be on "/use/borrow-renew-return/course-reserves"
    Given I follow "Search Course Reserves"
    Then I should be on "/vwebv/enterCourseReserve.do"

  Scenario: #1H
    Given I fill in "Site Search" with "course reserves"
    And I click the "#submit" element
    Then I should be on "/site-search?search_query=Course+reserve"
    Given I click the ".field-content a:powell/collections/course-reserves" element
    Then I should be on "/powell/collections/course-reserves"
    Given I follow "Course Reserves"
    Then I should be on "/use/borrow-renew-return/course-reserves"
    Given I follow "Course Reserves"
    Then I should be on "/vwebv/enterCourseReserve.do"

  Scenario: #1I
    Given I follow "Arts Library"
    Then I should be on "/arts"
    Given I follow "Course Reserves"
    Then I should be on "/use/borrow-renew-return/course-reserves"
    Given I follow "Search Course Reserves"
    Then I should be on "/vwebv/enterCourseReserve.do"

  Scenario: #1J
    Given I follow "Arts Library"
    Then I should be on "/arts"
    Given I follow "Collections"
    Then I should be on "arts/collections"
    Given I follow "Course Reserves"
    Then I should be on "/use/borrow-renew-return/course-reserves"
    Given I follow "Search Course Reserves"
    Then I should be on "/vwebv/enterCourseReserve.do"

  Scenario: #1K
    Given I follow "Powell Library"
    Then I should be on "/powell"
    Given I follow "Search Course Reserves"
    Then I should be on "/vwebv/enterCourseReserve.do"

  Scenario: #1L
    Given I follow "Powell Library"
    Then I should be on "/powell"
    Given I follow "Collections"
    Then I should be on "/powell/collections"
    Given I follow "Course Reserves"
    Then I should be on "/use/borrow-renew-return/course-reserves"
    Given I follow "Search Course Reserves"
    Then I should be on "/vwebv/enterCourseReserve.do"

  Scenario: #1M
    Given I follow "Science and Engineering Library"
    Then I should be on "/sel"
    Given I follow "Search Course Reserves"
    Then I should be on "/vwebv/enterCourseReserve.do"
