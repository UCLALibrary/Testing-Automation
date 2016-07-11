Feature: Find Articles Plus on the library website
  In order to find Articles Plus on the library website
  As an anonymous user
  I need to verify that these links work from different paths

  Background:
    Given I go to [/home]

    @javascript @homepage @sidebar @search @css @topic
    Scenario: #1A
      Given I follow [/articles_link]
      And wait 2 second
      Then I should be on [/articles_url]
      Then I fill in [/#articlesplus/articlessearch_text] with [/#articlesplus/articlessearch_search:”New York Times”]
      Then I click the [/#articlesplus/articlessearch_submit] element
      And wait 2 second
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript @homepage @sidebar @search @css @topic @filter
    Scenario: #1B
      Given I follow [/articles_link]
      And wait 2 second
      Then I should be on [/articles_url]
      Then I fill in [/#articlesplus/articlessearch_text] with "New York"
      And I select the [/#articlesplus/limittopeerreview_filter] radio button
      Then I click the [/#articlesplus/articlessearch_submit] element
      And wait 2 second
      Then I should be on [/#articlesplus/articlessearch_query:”New York”]

    @javascript @homepage @sidebar @search @css @topic
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

    @javascript @homepage @search @css @topic
    Scenario: #1D
      Given I follow [/newtoolarticlesplus_link]
      Then I should be on [/articlesplus_url]
      Then I fill in "" with [/#articlesplus/articlessearch_search:”New York Times”]
      And I click the [/articleplus_submit] element
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript @homepage @sidebar @search @topic @css
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

    @javascript @homepage @sidebar @search @advanced @topic @css
    Scenario: #1F
      Given I follow [/articles_link]
      Then I should be on [/articles_url]
      Then I follow [/#articlesplus/advancedsearch_link]
      Then I should be on [/#articlesplus/advancedsearch_url]
      Then I fill in [/#articlesplus/advancedsearch_text] with [/#articlesplus/articlessearch_search:”New York Times”]
      Then I click the [/#articlesplus/advancedsearch_submit] element
      And wait 3 second
      Then I should be on [/#articlesplus/advancedsearch_query:”New York Times”]

    @javascript @homepage @navbar @search @topic @css
    Scenario: #1G
      Given I follow [/search_link]
      Then I should be on [/search_url]
      Then I follow [/search/aboutarticlesplus_link]
      Then I should be on [/#articlesplus/about_url]
      Then I follow [/articles_link]
      Then I should be on [/articlesplus_url]
      Then I fill in "" with [/#articlesplus/articlessearch_search:”New York Times”]
      And I click the [/articleplus_submit] element
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript @homepage @navbar @search @topic @css
    Scenario: #1H
      Given I follow [/search_link]
      Then I should be on [/search_url]
      Then I follow [/search/quickarticles_link]
      Then I should be on [/search/quickarticles_url]
      Then I follow [/articles_link]
      Then I should be on [/articles_url]
      Then I fill in [/#articlesplus/articlessearch_text] with [/#articlesplus/articlessearch_search:”New York Times”]
      Then I click the [/#articlesplus/articlessearch_submit] element
      And wait 2 second
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript @search @css @page @topic
    Scenario: #1I
      Given I fill in [/sitesearch_text] with [/articles_link]
      Then I click the [/submit_element] element
      And wait 2 second
      Then I should be on [/sitesearchresult_url:”ArticlesPlus”]
      Then I follow [/search/aboutarticlesplus_link]
      Then I should be on [/#articlesplus/about_url]
      Then I follow [/articles_link]
      Then I should be on [/articlesplus_url]
      Then I fill in "" with [/#articlesplus/articlessearch_search:”New York Times”]
      Then I click the [/articleplus_submit] element
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript @search @css @page @topic
    Scenario: #1J
      Given I fill in [/sitesearch_text] with [/articles_link]
      Then I click the [/submit_element] element
      And wait 2 second
      Then I should be on [/sitesearchresult_url:”ArticlesPlus”]
      Then I go to [/aboutarticlesplus_url]
      Then I follow [/articles_link]
      Then I should be on [/articles_url]
      Then I fill in [/#articlesplus/articlessearch_text] with [/#articlesplus/articlessearch_search:”New York Times”]
      Then I click the [/#articlesplus/articlessearch_submit] element
      And wait 2 second
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]

    @javascript @search @page @css @topic
    Scenario: #1K
      Given I fill in [/sitesearch_text] with [/articles_link]
      Then I click the [/submit_element] element
      And wait 2 second
      Then I should be on [/sitesearchresult_url:”ArticlesPlus”]
      Then I follow [/aboutarticlesplus/quickarticlesearch_link]
      Then I should be on [/search/quickarticles_url]
      Then I follow [/articles_link]
      Then I should be on [/articles_url]
      Then I fill in [/#articlesplus/articlessearch_text] with [/#articlesplus/articlessearch_search:”New York Times”]
      Then I click the [/#articlesplus/articlessearch_submit] element
      And wait 2 second
      Then I should be on [/#articlesplus/articlessearch_query:”New York Times”]
