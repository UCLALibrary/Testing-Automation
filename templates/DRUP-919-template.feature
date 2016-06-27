Feature: Renewing a Checked Out Book
  In order to renew a checked out book on the Library website
  As an anonymous user
  I need to make sure these links are valid under varying paths

  Background:
    Given I go to [/home]

    Scenario: #1A
      Given I follow [/renew_link]
      Then I should be on [/renew_url]
      Given I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]
      Given I follow [/login_link]
      Then I should be on [/libacc_url]

    Scenario: #1B
      Given I follow [/renew_link]
      Then I should be on [/renew_url]
      Given I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]
      Given I follow [/libacc_link]
      Then I should be on [/libacc_url]

    Scenario: #1C
      Given I follow [/renew_link]
      Then I should be on [/renew_url]
      Given I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]
      Given I follow [/catalogbookbag_link]
      Then I should be on [/libacc_url]

    Scenario: #1D
      Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”Renew Book”]
      And I click the [/submit_element] element
      Then I should be on [/sitesearchresult_query:”Renew Book”]
      Given I follow [/sitesearchresult_link:”Renew Book”]
      Then I should be on [/renew_url]
      Given I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]

    Scenario: #1E
      //Given I follow [/books_link]
      //Then I should be on [/books_url]
      Given I select the [/uclacatalog_filter] radio button
      And I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]

    Scenario: #1F
      Given I follow [/use_link]
      Then I should be on [/use_url]
      Given I follow [/use/return_link]
      Then I should be on [/renew_url]
      Given I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]

    Scenario: #1G
      Given I follow [/use_link]
      Then I should be on [/use_url]
      Given I follow "Borrow, Renew, Return"
      Then I should be on [/use/borrowrenewreturn_url]
      Given I follow [/use/return_link]
      Then I should be on [/renew_url]
      Given I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]

    Scenario: #2A
      Given I select the [/uclacatalog_filter] radio button
      And I follow [/uclacatalog_filter]
      Then I should be on [/booksbasicsearch_link]
      Given I follow [/advanced_link]
      Then I should be on [/advanced_url]
