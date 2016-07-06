Feature: Accessing Databases
  In order to access databases
  As an anonymous user
  I need to verify that these links work from different paths

  Background:
    Given I go to "https://www.library.ucla.edu"

#    @javascript
#    Scenario: #1A
#      Then I follow "Databases"
#      Then I should be on "/#databases"
#      Then I fill in "Search for a database." with "PsycINFO"
#      Then I click the "#edit-databases-databases-search" element
#      Then I should be on "/az.php?q=PsycINFO"
#      Then I follow "PsycINFO"
#      Then I switch to the next window
#      Then I should be on "/psycinfo/advanced"

    @javascript @homepage @sidebar @search @page @multiwindow @css
    Scenario: #1B
      Then I follow "Databases"
      Then I should be on "/#databases"
      Then I fill in "Search for a database." with "PsycINFO"
      Then I click the "#edit-databases-databases-search" element
      Then I should be on "/az.php?q=PsycINFO"
      Then I follow "PsycINFO"
      Then I switch to the next window
      Then I should be on "/psycinfo/advanced"

    @javascript @homepage @sidebar @search @page @multiwindow @css
    Scenario: #1C
      Then I follow "Databases"
      Then I should be on "/#databases"
      Then I follow "A-Z List of Databases"
      Then I should be on "/az.php"
      Then I follow "P"
      Then I should be on "/az.php?a=p"
      Then I fill in "Find databases by a keyword or EXACT phrase from the title or description" with "PsycINFO"
      Then I click the "button.btn.btn-default" element
      Then I should be on "/az.php?a=p&q=PsycINFO"
      Then wait 2 second
      Then I follow "PsycINFO"
      Then wait 2 second
      Then I switch to the next window
      Then wait 2 second
      Then I should be on "/psycinfo/advanced"

    @javascript @homepage @sidebar @css @multiwindow @search @page
    Scenario: #1D
      Then I follow "Databases"
      Then I should be on "/#databases"
      Then I follow "Find Databases by Subject"
      Then I should be on "/databases-by-subject"
      Then I fill in "Search for a Database" with "PsycINFO"
      Then I click the "button.s-lg-btn-api-drop.btn.btn-default" element
      Then I switch to the next window
      Then I should be on "/az.php?q=PsycINFO"
      Then I follow "PsycINFO"
      Then I switch to the next window
      Then I should be on "/psycinfo/advanced"

    Scenario: #1E @homepage @navbar @search
      Then I follow "Search"
      Then I should be on "/search"
      Then I follow "Browse Databases by Subject"
      Then I should be on "/databases-by-subject"

    @javascript @homepage @search @css @page @multiwindow
    Scenario: #1F
      Then I follow "Search"
      Then I should be on "/search"
      Then I follow "Find a Database by Title"
      Then I should be on "/az.php"
      Then I fill in "Find databases by a keyword or EXACT phrase from the title or description" with "PsycINFO"
      Then I click the "button.btn.btn-default" element
      Then wait 2 second
      Then I follow "PsycINFO"
      Then I switch to the next window
      Then I should be on "/psycinfo/advanced"

    @javascript @homepage @navbar @multiwindow @css @page
    Scenario: #1G
      Then I follow "Search"
      Then I should be on "/search"
      Then I follow "A-Z List of Databases"
      Then I switch to the next window
      Then I should be on "/az.php"
      Then I fill in "Find databases by a keyword or EXACT phrase from the title or description" with "PsycINFO"
      Then I click the "button.btn.btn-default" element
      Then wait 2 second
      Then I follow "PsycINFO"
      Then I switch to the next window
      Then I should be on "/psycinfo/advanced"