Feature: Find Articles Plus on the library website
  In order to find Articles Plus on the library website
  As an anonymous user
  I need to verify that these links work from different paths

  Background:
    Given I go to "https://www.library.ucla.edu"

    @javascript @homepage @sidebar @search @css @topic
    Scenario: #1A
      Given I follow "ArticlesPlus"
      And wait 2 second
      Then I should be on "/#articlesplus"
      Then I fill in "Search several databases at once." with "New York Times"
      Then I click the "#edit-articlesplus-articlesplus-search" element
      And wait 2 second
      Then I should be on "/#!/search?ho=t&l=en&q=New%20York%20Times"

    @javascript @homepage @sidebar @search @css @topic @filter
    Scenario: #1B
      Given I follow "ArticlesPlus"
      And wait 2 second
      Then I should be on "/#articlesplus"
      Then I fill in "Search several databases at once." with "New York"
      And I select the "Limit to peer-reviewed" radio button
      Then I click the "#edit-articlesplus-articlesplus-search" element
      And wait 2 second
      Then I should be on "/#!/search?ho=t&fvf=IsScholarly,true,f&l=en&q=New%20York"

    @javascript @homepage @sidebar @search @css @topic
    Scenario: #1C
      Given I follow "ArticlesPlus"
      And wait 2 second
      Then I should be on "/#articlesplus"
      Then I follow "ArticlesPlus"
      And wait 2 second
      Then I should be on "/#!/"
      Then I fill in "" with "New York Times"
      And I click the "button.btn.btn-inverse.ng-binding" element
      And wait 2 second
      Then I should be on "/#!/search?ho=t&l=en&q=New%20York%20Times"

    @javascript @homepage @search @css @topic
    Scenario: #1D
      Given I follow "New Search Tool: ArticlesPlus"
      Then I should be on "/#!/"
      Then I fill in "" with "New York Times"
      And I click the "button.btn.btn-inverse.ng-binding" element
      Then I should be on "/#!/search?ho=t&l=en&q=New%20York%20Times"

    @javascript @homepage @sidebar @search @topic @css
    Scenario: #1E
      Given I follow "ArticlesPlus"
      Then I should be on "/#articlesplus"
      Then I follow "about ArticlesPlus"
      Then I should be on "/about-articlesplus"
      Then I follow "ArticlesPlus"
      Then I should be on "/#!/"
      Then I fill in "" with "New York Times"
      And I click the "button.btn.btn-inverse.ng-binding" element
      Then I should be on "/#!/search?ho=t&l=en&q=New%20York%20Times"

    @javascript @homepage @sidebar @search @advanced @topic @css
    Scenario: #1F
      Given I follow "ArticlesPlus"
      Then I should be on "/#articlesplus"
      Then I follow "Advanced Search"
      Then I should be on "/advanced#!/advanced"
      Then I fill in "searchValue" with "New York Times"
      Then I click the "button#advSearchSubmit.btn.btn-inverse.ng-binding" element
      And wait 3 second
      Then I should be on "/advanced#!/search?ho=t&l=en&q=(New%20York%20Times)"

    @javascript @homepage @navbar @search @topic @css
    Scenario: #1G
      Given I follow "Search"
      Then I should be on "/search"
      Then I follow "About ArticlesPlus"
      Then I should be on "/about-articlesplus"
      Then I follow "ArticlesPlus"
      Then I should be on "/#!/"
      Then I fill in "" with "New York Times"
      And I click the "button.btn.btn-inverse.ng-binding" element
      Then I should be on "/#!/search?ho=t&l=en&q=New%20York%20Times"

    @javascript @homepage @navbar @search @topic @css
    Scenario: #1H
      Given I follow "Search"
      Then I should be on "/search"
      Then I follow "Quick Articles"
      Then I should be on "/quick-article-search"
      Then I follow "ArticlesPlus"
      Then I should be on "/#articlesplus"
      Then I fill in "Search several databases at once." with "New York Times"
      Then I click the "#edit-articlesplus-articlesplus-search" element
      And wait 2 second
      Then I should be on "/#!/search?ho=t&l=en&q=New%20York%20Times"

    @javascript @search @css @page @topic
    Scenario: #1I
      Given I fill in "Site Search" with "ArticlesPlus"
      Then I click the "#submit" element
      And wait 2 second
      Then I should be on "/site-search?search_query=ArticlesPlus"
      Then I follow "About ArticlesPlus"
      Then I should be on "/about-articlesplus"
      Then I follow "ArticlesPlus"
      Then I should be on "/#!/"
      Then I fill in "" with "New York Times"
      Then I click the "button.btn.btn-inverse.ng-binding" element
      Then I should be on "/#!/search?ho=t&l=en&q=New%20York%20Times"

    @javascript @search @css @page @topic
    Scenario: #1J
      Given I fill in "Site Search" with "ArticlesPlus"
      Then I click the "#submit" element
      And wait 2 second
      Then I should be on "/site-search?search_query=ArticlesPlus"
      Then I go to "http://www.library.ucla.edu/about-articlesplus-0"
      Then I follow "ArticlesPlus"
      Then I should be on "/#articlesplus"
      Then I fill in "Search several databases at once." with "New York Times"
      Then I click the "#edit-articlesplus-articlesplus-search" element
      And wait 2 second
      Then I should be on "/#!/search?ho=t&l=en&q=New%20York%20Times"

    @javascript @search @page @css @topic
    Scenario: #1K
      Given I fill in "Site Search" with "ArticlesPlus"
      Then I click the "#submit" element
      And wait 2 second
      Then I should be on "/site-search?search_query=ArticlesPlus"
      Then I follow "Quick Article Search"
      Then I should be on "/quick-article-search"
      Then I follow "ArticlesPlus"
      Then I should be on "/#articlesplus"
      Then I fill in "Search several databases at once." with "New York Times"
      Then I click the "#edit-articlesplus-articlesplus-search" element
      And wait 2 second
      Then I should be on "/#!/search?ho=t&l=en&q=New%20York%20Times"