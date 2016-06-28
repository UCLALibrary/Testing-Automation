Feature: Find Articles Plus on the library website
  In order to find Articles Plus on the library website
  As an anonymous user
  I need to verify that these links work from different paths

  Background:
    Given I go to [/home]

    @javascript
    Scenario: #1A
      Given I follow [/articles_link]
      And wait 2 second
      Then I should be on [/articles_url]
      Then I fill in [/#articlesplus/articlessearch_text] with [/#articlesplus/articlessearch_search:”New York Times”]
      Then I click the [/#articlesplus/articlessearch_submit] element
      And wait 2 second
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript
    Scenario: #1B
      Given I follow [/articles_link]
      And wait 2 second
      Then I should be on [/articles_url]
      Then I fill in [/#articlesplus/articlessearch_text] with "New York"
      And I select the [/#articlesplus/limittopeerreview_filter] radio button
      Then I click the [/#articlesplus/articlessearch_submit] element
      And wait 2 second
      Then I should be on "/#!/search?ho=t&fvf=IsScholarly,true,f&l=en&q=New%20York"

    @javascript
    Scenario: #1C
      Given I follow [/articles_link]
      And wait 2 second
      Then I should be on [/articles_url]
      Then I follow [/articles_link]
      And wait 2 second
      Then I should be on [/articlesplus_url]
      Then I fill in "" with [/#articlesplus/articlessearch_search:”New York Times”]
      And I click the [/articleplus_submit] element
      And wait 2 second
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript
    Scenario: #1D
      Given I follow [/newtoolarticlesplus_link]
      Then I should be on [/articlesplus_url]
      Then I fill in "" with [/#articlesplus/articlessearch_search:”New York Times”]
      And I click the [/articleplus_submit] element
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript
    Scenario: #1E
      Given I follow [/articles_link]
      Then I should be on [/articles_url]
      Then I follow [/#articlesplus/about_link]
      Then I should be on [/#articlesplus/about_url]
      Then I follow [/articles_link]
      Then I should be on [/articlesplus_url]
      Then I fill in "" with [/#articlesplus/articlessearch_search:”New York Times”]
      And I click the [/articleplus_submit] element
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript
    Scenario: #1F
      Given I follow [/articles_link]
      Then I should be on [/articles_url]
      Then I follow "Advanced Search"
      Then I should be on "/advanced#!/advanced"
      Then I fill in "searchValue" with [/#articlesplus/articlessearch_search:”New York Times”]
      Then I click the "button#advSearchSubmit.btn.btn-inverse.ng-binding" element
      And wait 3 second
      Then I should be on "/advanced#!/search?ho=t&l=en&q=(New%20York%20Times)"

    @javascript
    Scenario: #1G
      Given I follow [/search_link]
      Then I should be on [/search_url]
      Then I follow "About ArticlesPlus"
      Then I should be on [/#articlesplus/about_url]
      Then I follow [/articles_link]
      Then I should be on [/articlesplus_url]
      Then I fill in "" with [/#articlesplus/articlessearch_search:”New York Times”]
      And I click the [/articleplus_submit] element
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript
    Scenario: #1H
      Given I follow [/search_link]
      Then I should be on [/search_url]
      Then I follow "Quick Articles"
      Then I should be on "/quick-article-search"
      Then I follow [/articles_link]
      Then I should be on [/articles_url]
      Then I fill in [/#articlesplus/articlessearch_text] with [/#articlesplus/articlessearch_search:”New York Times”]
      Then I click the [/#articlesplus/articlessearch_submit] element
      And wait 2 second
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript
    Scenario: #1I
      Given I fill in [/sitesearch_text] with [/articles_link]
      Then I click the [/submit_element] element
      And wait 2 second
      Then I should be on "/site-search?search_query=ArticlesPlus"
      Then I follow "About ArticlesPlus"
      Then I should be on [/#articlesplus/about_url]
      Then I follow [/articles_link]
      Then I should be on [/articlesplus_url]
      Then I fill in "" with [/#articlesplus/articlessearch_search:”New York Times”]
      Then I click the [/articleplus_submit] element
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript
    Scenario: #1J
      Given I fill in [/sitesearch_text] with [/articles_link]
      Then I click the [/submit_element] element
      And wait 2 second
      Then I should be on "/site-search?search_query=ArticlesPlus"
      Then I go to "http://www.library.ucla.edu/about-articlesplus-0"
      Then I follow [/articles_link]
      Then I should be on [/articles_url]
      Then I fill in [/#articlesplus/articlessearch_text] with [/#articlesplus/articlessearch_search:”New York Times”]
      Then I click the [/#articlesplus/articlessearch_submit] element
      And wait 2 second
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript
    Scenario: #1K
      Given I fill in [/sitesearch_text] with [/articles_link]
      Then I click the [/submit_element] element
      And wait 2 second
      Then I should be on "/site-search?search_query=ArticlesPlus"
      Then I follow "Quick Article Search"
      Then I should be on "/quick-article-search"
      Then I follow [/articles_link]
      Then I should be on [/articles_url]
      Then I fill in [/#articlesplus/articlessearch_text] with [/#articlesplus/articlessearch_search:”New York Times”]
      Then I click the [/#articlesplus/articlessearch_submit] element
      And wait 2 second
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]
