Feature: CLICC Resources Part II
  In order to find CLICC Resources
  As an anonymous user
  I need to verify that these links work from different paths

  Background:
    Given I go to "https://www.library.ucla.edu"

    Scenario: #1A
      Then I follow "Use CLICC Laptops and Services"
      Then I should be on "/clicc"
      Then I follow "CLICC Computer Lab"
      Then I should be on "/powell/clicc-computer-lab"

    Scenario: #1B
      Then I follow "Use CLICC Laptops and Services"
      Then I should be on "/clicc"
      Then I follow "CLICC Classrooms"
      Then I should be on "/clicc/clicc-classrooms"

    Scenario: #1C
      Then I follow "Use CLICC Laptops and Services"
      Then I should be on "/clicc"
      Then I follow "Printers and Scanners"
      Then I should be on "/clicc/printers-scanners"

    Scenario: #1D
      Then I follow "Use CLICC Laptops and Services"
      Then I should be on "/clicc"
      Then I follow "Laptops & More"
      Then I should be on "/clicc/lending"