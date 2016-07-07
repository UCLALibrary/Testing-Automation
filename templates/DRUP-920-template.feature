Feature: Using Library Resources Away From Campus
  In order to find how to use library resources away from campus on the library website
  As an anonymous user
  I need to make sure these links are valid under varying paths

  Background:
    Given I go to [/home]

  @misc @connect
  Scenario: #1A
    Given I follow [/connect_link]
    Then I should be on [/connect_url]

  @search @misc @connect @css @topic
  Scenario: #1B
    Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”VPN”]
    And I click the [/submit_element] element
    Then I should be on [/sitesearchresult_query:”VPN”]
    Given I follow [/connect_link]
    Then I should be on [/connect_url]

  @homepage @navbar @misc @connect
  Scenario: #1C
    Given I follow [/search_link]
    Then I should be on [/search_url]
    Given I follow [/connect_link]
    Then I should be on [/connect_url]

  @homepage @navbar @misc @connect
  Scenario: #1D
    Given I follow [/support_link]
    Then I should be on [/support_url]
    Given I follow [/connect_link]
    Then I should be on [/connect_url]

  @homepage @navbar @misc @connect
  Scenario: #1E
    Given I follow [/use_link]
    Then I should be on [/use_url]
    Given I follow [/connect_link]
    Then I should be on [/connect_url]

  @misc @connect
  Scenario: #1F
    Given I follow [/connect_link]
    Then I should be on [/connect_url]
    Given I follow [/connect/proxy_link]
    Then I should be on [/connect/proxy_url]

  @misc @connect
  Scenario: #1G
    Given I follow [/connect_link]
    Then I should be on [/connect_url]
    Given I follow [/connect/vpn_link]
    Then I should be on [/connect/vpn_url]

  @misc @connect
  Scenario: #1H
    Given I follow [/connect_link]
    Then I should be on [/connect_url]
    Given I follow [/connect/vpnmobile_link]
    Then I should be on [/connect/vpnmobile_url]

  @misc @connect
  Scenario: #1I
    Given I follow [/connect_link]
    Then I should be on [/connect_url]
    Given I follow [/connect/vpnmednet_link]
    Then I should be on [/connect/vpnmednet_url]

  @misc @connect
  Scenario: #1J
    Given I follow [/connect_link]
    Then I should be on [/connect_url]
    Given I follow [/connect/proxyanderson_link]
    Then I should be on [/connect/proxyanderson_url]
