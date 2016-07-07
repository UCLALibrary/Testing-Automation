Feature: Renewing a Checked Out Book
  In order to renew a checked out book on the Library website
  As an anonymous user
  I need to make sure these links are valid under varying paths

  Background:
    Given I go to [/home]

    @misc @renew @catalog @search
    Scenario: #1A
      Given I follow [/renew_link]
      Then I should be on [/renew_url]
      Given I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]
      Given I follow [/login_link]
      Then I should be on [/libacc_url]

    @misc @renew @catalog @search
    Scenario: #1B
      Given I follow [/renew_link]
      Then I should be on [/renew_url]
      Given I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]
      Given I follow [/libacc_link]
      Then I should be on [/libacc_url]

  @misc @renew @catalog @search
  Scenario: #1C
      Given I follow [/renew_link]
      Then I should be on [/renew_url]
      Given I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]
      Given I follow [/catalogbookbag_link]
      Then I should be on [/libacc_url]

  @misc @renew @catalog @search @css @topic
  Scenario: #1D
      Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”Renew Book”]
      And I click the [/submit_element] element
      Then I should be on [/sitesearchresult_query:”Renew Book”]
      Given I follow [/sitesearchresult_link:”Renew Book”]
      Then I should be on [/renew_url]
      Given I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]

  @misc @renew @catalog @search @filter
  Scenario: #1E
      //Given I follow [/books_link]
      //Then I should be on [/books_url]
      Given I select the [/uclacatalog_filter] radio button
      And I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]

  @misc @renew @catalog @search @homepage @navbar
  Scenario: #1F
      Given I follow [/use_link]
      Then I should be on [/use_url]
      Given I follow [/use/return_link]
      Then I should be on [/renew_url]
      Given I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]

  @misc @renew @catalog @search @homepage @navbar
  Scenario: #1G
      Given I follow [/use_link]
      Then I should be on [/use_url]
      Given I follow [/use/borrowrenewreturn_link]
      Then I should be on [/use/borrowrenewreturn_url]
      Given I follow [/use/return_link]
      Then I should be on [/renew_url]
      Given I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]

  @misc @renew @catalog @search @filter @advanced
  Scenario: #2A
      Given I select the [/uclacatalog_filter] radio button
      And I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]
      Given I follow [/advanced_link]
      Then I should be on [/advanced_url]
