Feature: CLICC Resources
  In order to access the CLICC Resources page
  As an anonymous user
  I need to make sure that the page is accessible from multiple paths

  Background:
    Given I go to "https://www.library.ucla.edu"

  @clicc @services
  Scenario: #1A
    Given I follow "Use CLICC Laptops and Services"
    Then I should be on "/clicc"

  @search @page @clicc @css
  Scenario: #1B
    Given I fill in "Site Search" with "clicc"
    And I click the "#submit" element
    Then I should be on "/site-search?search_query=clicc"
    Given I follow "CLICC"
    Then I should be on "/clicc"

  @clicc @locations @powell @computerlab
  Scenario: #1C
    Given I follow "Laptop Lending (CLICC)"
    Then I should be on "/locations?f[0]=field_equipment%3A100"
    Given I follow "Powell Library"
    Then I should be on "/powell"
    Given I follow "CLICC Computer Lab"
    Then I should be on "/powell/clicc-computer-lab"
    Given I follow "CLICC"
    Then I should be on "/clicc"

  @locations @powell @clicc @computerlab
  Scenario: #1D
    Given I follow "Powell Library"
    Then I should be on "/powell"
    Given I follow "CLICC Computer Lab"
    Then I should be on "/powell/clicc-computer-lab"
    Given I follow "CLICC"
    Then I should be on "/clicc"

  @powell @locations @lending @clicc @computerspecs
  Scenario: #1E
    Given I follow "Powell Library"
    Then I should be on "/powell"
    Given I follow "CLICC Laptop Lending (Powell Library)"
    Then I should be on "/powell/clicc-laptop-lending-powell-library"
    Given I follow "CLICC Computer Specs"
    Then I should be on "/clicc"

  @locations @yrl @lending @computerspecs
  Scenario: #1F
    Given I follow "Research Library (Charles E. Young)"
    Then I should be on "/yrl"
    Given I follow "CLICC Laptop Lending (Research Library)"
    Then I should be on "/yrl/clicc-laptop-lending-research-library"
    Given I follow "CLICC Computer Specs"
    Then I should be on "/clicc"

  @homepage @navbar @clicc
  Scenario: #1G
    Given I follow "Research & Teaching Support"
    Then I should be on "/support"
    Given I follow "CLICC Laptops and Services"
    Then I should be on "/clicc"

  @homepage @navbar @clicc
  Scenario: #1H
    Given I follow "Using the Library"
    Then I should be on "/use"
    Given I follow "CLICC Laptops & Services"
    Then I should be on "/clicc"

  @homepage @navbar @clicc @classrooms
  Scenario: #1I
    Given I follow "Using the Library"
    Then I should be on "/use"
    Given I follow "CLICC Laptops, Lab, and Classrooms"
    Then I should be on "/clicc"

  @homepage @navbar @locations @powell @clicc @computerlab
  Scenario: #1J
    Given I follow "Locations"
    Then I should be on "/locations"
    Given I follow "Powell Library"
    Then I should be on "/powell"
    Given I follow "CLICC Computer Lab"
    Then I should be on "/powell/clicc-computer-lab"
    Given I follow "CLICC"
    Then I should be on "/clicc"

  @locations @yrl @clicc @lending @computerspecs
  Scenario: #1K
    Given I follow "Locations"
    Then I should be on "/locations"
    Given I follow "Research Library (Charles E. Young)"
    Then I should be on "/yrl"
    Given I follow "CLICC Laptop Lending (Research Library)"
    Then I should be on "/yrl/clicc-laptop-lending-research-library"
    Given I follow "CLICC Computer Specs"
    Then I should be on "/clicc"
