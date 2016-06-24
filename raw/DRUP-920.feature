Feature: Using Library Resources Away From Campus
  In order to find how to use library resources away from campus on the library website
  As an anonymous user
  I need to make sure these links are valid under varying paths

  Background:
    Given I go to "https://www.library.ucla.edu"

  Scenario: #1A
    Given I follow "Connect from off-campus"
    Then I should be on "/use/computers-computing-services/connect-campus"

  Scenario: #1B
    Given I fill in "Site Search" with "VPN"
    And I click the "#submit" element
    Then I should be on "/site-search?search_query=vpn"
    Given I follow "Connect from Off-Campus"
    Then I should be on "/use/computers-computing-services/connect-campus"

  Scenario: #1C
    Given I follow "Search"
    Then I should be on "/search"
    Given I follow "Connect from off-campus"
    Then I should be on "/use/computers-computing-services/connect-campus"

  Scenario: #1D
    Given I follow "Research & Teaching Support"
    Then I should be on "/support"
    Given I follow "Connect from Off-Campus"
    Then I should be on "/use/computers-computing-services/connect-campus"

  Scenario: #1E
    Given I follow "Using the Library"
    Then I should be on "/use"
    Given I follow "Connect from Off-Campus"
    Then I should be on "/use/computers-computing-services/connect-campus"

  Scenario: #1F
    Given I follow "Connect from off-campus"
    Then I should be on "/use/computers-computing-services/connect-campus"
    Given I follow "Proxy Server"
    Then I should be on "/services/proxy/"

  Scenario: #1G
    Given I follow "Connect from off-campus"
    Then I should be on "/use/computers-computing-services/connect-campus"
    Given I follow "Virtual Private Networking (VPN)"
    Then I should be on "/services/vpn/"

  Scenario: #1H
    Given I follow "Connect from off-campus"
    Then I should be on "/use/computers-computing-services/connect-campus"
    Given I follow "VPN for Mobile Devices"
    Then I should be on "/services/vpn/pda/"

  Scenario: #1I
    Given I follow "Connect from off-campus"
    Then I should be on "/use/computers-computing-services/connect-campus"
    Given I follow "Mednet VPN"
    Then I should be on "/body.cfm?id=25"

  Scenario: #1J
    Given I follow "Connect from off-campus"
    Then I should be on "/use/computers-computing-services/connect-campus"
    Given I follow "UCLA Anderson Proxy Server"
    Then I should be on "/rosenfeld-library/databases/anderson-proxy-server--off-campus-access"