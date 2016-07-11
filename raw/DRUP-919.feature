Feature: Renewing a Checked Out Book
  In order to renew a checked out book on the Library website
  As an anonymous user
  I need to make sure these links are valid under varying paths

  Background:
    Given I go to "https://www.library.ucla.edu"

    @misc @renew @catalog @search
    Scenario: #1A
      Given I follow "Renew a book"
      Then I should be on "/use/borrow-renew-return/renewing-and-returning-items"
      Given I follow "UCLA Library Catalog"
      Then I should be on "/vwebv/searchBasic"
      Given I follow "Log in"
      Then I should be on "/vwebv/login"

    @misc @renew @catalog @search
    Scenario: #1B
      Given I follow "Renew a book"
      Then I should be on "/use/borrow-renew-return/renewing-and-returning-items"
      Given I follow "UCLA Library Catalog"
      Then I should be on "/vwebv/searchBasic"
      Given I follow "My Account/Renew Books"
      Then I should be on "/vwebv/login"

  @misc @renew @catalog @search
  Scenario: #1C
      Given I follow "Renew a book"
      Then I should be on "/use/borrow-renew-return/renewing-and-returning-items"
      Given I follow "UCLA Library Catalog"
      Then I should be on "/vwebv/searchBasic"
      Given I follow "My Bookbag"
      Then I should be on "/vwebv/login"

  @misc @renew @catalog @search @css @topic
  Scenario: #1D
      Given I fill in "Site Search" with "Renew Book"
      And I click the "#submit" element
      Then I should be on "/site-search?search_query=renew+book"
      Given I follow "Renewing and returning items"
      Then I should be on "/use/borrow-renew-return/renewing-and-returning-items"
      Given I follow "UCLA Library Catalog"
      Then I should be on "/vwebv/searchBasic"

  @misc @renew @catalog @search @filter
  Scenario: #1E
      //Given I follow "Books & More"
      //Then I should be on "/#books"
      Given I select the "UCLA Library Catalog" radio button
      And I follow "UCLA Library Catalog"
      Then I should be on "/vwebv/searchBasic"

  @misc @renew @catalog @search @homepage @navbar
  Scenario: #1F
      Given I follow "Using the Library"
      Then I should be on "/use"
      Given I follow "Renewing and Returning Items"
      Then I should be on "/use/borrow-renew-return/renewing-and-returning-items"
      Given I follow "UCLA Library Catalog"
      Then I should be on "/vwebv/searchBasic"

  @misc @renew @catalog @search @homepage @navbar
  Scenario: #1G
      Given I follow "Using the Library"
      Then I should be on "/use"
      Given I follow "Borrow, Renew, Return"
      Then I should be on "/use/borrow-renew-return"
      Given I follow "Renewing and Returning Items"
      Then I should be on "/use/borrow-renew-return/renewing-and-returning-items"
      Given I follow "UCLA Library Catalog"
      Then I should be on "/vwebv/searchBasic"

  @misc @renew @catalog @search @filter @advanced
  Scenario: #2A
      Given I select the "UCLA Library Catalog" radio button
      And I follow "UCLA Library Catalog"
      Then I should be on "/vwebv/searchBasic"
      Given I follow "Advanced"
      Then I should be on "/vwebv/searchAdvanced"