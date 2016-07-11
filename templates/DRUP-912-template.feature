Feature: CLICC Resources
  In order to access the CLICC Resources page
  As an anonymous user
  I need to make sure that the page is accessible from multiple paths

  Background:
    Given I go to [/home]

  @clicc @services
  Scenario: #1A
    Given I follow [/clicc_link]
    Then I should be on [/clicc_url]

  @search @page @clicc @css
  Scenario: #1B
    Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”clicc”]
    And I click the [/submit_element] element
    Then I should be on [/sitesearchresult_query:”clicc”]
    Given I follow [/powell/clicc]
    Then I should be on [/clicc_url]

  @clicc @locations @powell @computerlab
  Scenario: #1C
    Given I follow [/lending_link]
    Then I should be on [/lending_url]
    Given I follow [/powlib_link]
    Then I should be on [/powlib_url]
    Given I follow [/powell/computerlab_link]
    Then I should be on [/powell/computerlab_url]
    Given I follow [/powell/clicc]
    Then I should be on [/clicc_url]

  @locations @powell @clicc @computerlab
  Scenario: #1D
    Given I follow [/powlib_link]
    Then I should be on [/powlib_url]
    Given I follow [/powell/computerlab_link]
    Then I should be on [/powell/computerlab_url]
    Given I follow [/powell/clicc]
    Then I should be on [/clicc_url]

  @powell @locations @lending @clicc @computerspecs
  Scenario: #1E
    Given I follow [/powlib_link]
    Then I should be on [/powlib_url]
    Given I follow [/powell/lending_link]
    Then I should be on [/powell/lending_url]
    Given I follow [/powell/computerspecs_link]
    Then I should be on [/clicc_url]

  @locations @yrl @lending @computerspecs
  Scenario: #1F
    Given I follow [/reslib_link]
    Then I should be on [/reslib_url]
    Given I follow [/yrl/lending_link]
    Then I should be on [/yrl/lending_url]
    Given I follow [/powell/computerspecs_link]
    Then I should be on [/clicc_url]

  @homepage @navbar @clicc
  Scenario: #1G
    Given I follow [/support_link]
    Then I should be on [/support_url]
    Given I follow [/support/laptops_link]
    Then I should be on [/clicc_url]

  @homepage @navbar @clicc
  Scenario: #1H
    Given I follow [/use_link]
    Then I should be on [/use_url]
    Given I follow [/use/laptops_link]
    Then I should be on [/clicc_url]

  @homepage @navbar @clicc @classrooms
  Scenario: #1I
    Given I follow [/use_link]
    Then I should be on [/use_url]
    Given I follow "CLICC Laptops, Lab, and Classrooms"
    Then I should be on [/clicc_url]

  @homepage @navbar @locations @powell @clicc @computerlab
  Scenario: #1J
    Given I follow [/locations_link]
    Then I should be on [/equip_link]
    Given I follow [/powlib_link]
    Then I should be on [/powlib_url]
    Given I follow [/powell/computerlab_link]
    Then I should be on [/powell/computerlab_url]
    Given I follow [/powell/clicc]
    Then I should be on [/clicc_url]

  @locations @yrl @clicc @lending @computerspecs
  Scenario: #1K
    Given I follow [/locations_link]
    Then I should be on [/equip_link]
    Given I follow [/reslib_link]
    Then I should be on [/reslib_url]
    Given I follow [/yrl/lending_link]
    Then I should be on [/yrl/lending_url]
    Given I follow [/powell/computerspecs_link]
    Then I should be on [/clicc_url]
