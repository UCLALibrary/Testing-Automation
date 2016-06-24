Feature: Course Reserve
  @javascript
  Scenario: 1A:
    Given I go to "http://library.ucla.edu"
    Then I click on the link "Books & More"
    Then I click on the link "Search Course Reserves"
    Then the url should match "/vwebv/enterCourseReserve.do"

  Scenario: 1B:
    Given I go to "http://www.library.ucla.edu"
    Then I follow "Search"
    Then the url should match "/search"
    Then I follow "Course Reserves"
    Then the url should match "/use/borrow-renew-return/course-reserves"
    Then I follow "Search Course Reserves"
    Then the url should match "/vwebv/enterCourseReserve.do"

  Scenario: 1C:
    Given I go to "http://library.ucla.edu"
    Then I follow "Search"
    Then the url should match "/search"
    Then I follow "Course Reserves"
    Then the url should match "/use/borrow-renew-return/course-reserves"
    Then I follow "UCLA Library Catalog Course Reserves Tab"
    Then I switch to the next tab
    Then the url should match "/vwebv/enterCourseReserve.do"

  Scenario: 1D
    Given I go to "http://library.ucla.edu"
    Then I follow "Research & Teaching Support"
    Then the url should match "/support"
    Then I follow "Support for Students"
    Then the url should match "/support/students"
    Then I follow "Get Course Materials on Reserve"
    Then the url should match "/use/borrow-renew-return/course-reserves"
    Then I follow "Search Course Reserves"
    Then the url should match "/vwebv/enterCourseReserve.do"

  Scenario: 1E:
    Given I go to "http://library.ucla.edu"
    Then I follow "Research & Teaching Support"
    Then the url should match "/support"
    Then I follow "Get Course Materials on Reserve"
    Then the url should match "/use/borrow-renew-return/course-reserves"
    Then I follow "Search Course Reserves"
    Then the url should match "/vwebv/enterCourseReserve.do"

  Scenario: 1F:
    Given I go to "http://www.library.ucla.edu"
    Then I follow "Research & Teaching Support"
    Then the url should match "/support"
    Then I follow "Course Reserves"
    Then the url should match "/use/borrow-renew-return/course-reserves"
    Then I follow "Search Course Reserves"
    Then the url should match "/vwebv/enterCourseReserve.do"

  Scenario: 1G:
    Given I go to "http://library.ucla.edu"
    Then I fill in "Site Search" with "course reserves"
    Then I click the "#submit" element
    Then the url should match "/site-search"
    Then I follow "Course Reserves"
    Then the url should match "/use/borrow-renew-return/course-reserves"
    Then I follow "Search Course Reserves"
    Then the url should match "vwebv/enterCourseReserve.do"