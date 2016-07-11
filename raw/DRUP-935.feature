Feature: Find Map of All Libraries
  In order to find map of all libraries
  As an anonymous user
  I need to verify that these links work on various paths

  Background:
    Given I go to "https://www.library.ucla.edu"

    @homepage @navbar @locations @map
    Scenario: #1A
      Given I follow "Locations"
      Then I should be on "/locations"
      Given I follow "Map of All Libraries"
      Then I should be on "/sites/default/files/libmap_091710.pdf"

    @clicc @gsr @locations @map
    Scenario: #1B
      Given I follow "Find a Group Study Room"
      Then I should be on "/locations?f%5B0%5D=field_study_areas%3A36"
      Given I follow "Map of All Libraries"
      Then I should be on "/sites/default/files/libmap_091710.pdf"

    @clicc @pod @locations @map
    Scenario: #1C
      Given I follow "Find a Collaboration Pod"
      Then I should be on "/locations?f%5B0%5D=field_study_areas%3A41"
      Given I follow "Map of All Libraries"
      Then I should be on "/sites/default/files/libmap_091710.pdf"
