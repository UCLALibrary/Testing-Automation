Feature: Biomedica Library Key Resources
  In order to find Biomedical Library Key Resources on the library website
  As an anonymous user
  I need to verify that these links work on various paths

  Background:
    Given I go to "https://www.library.ucla.edu"

    Scenario: #1A
      Given I follow "Biomedical Library (Louise M. Darling)"
      Then I should be on "/biomed"
      Given I follow "Key Resources"
      Then I should be on "/biomed/key-resources"

    Scenario: #1B
      Given I follow "Locations"
      Then I should be on "/locations"
      Given I follow "Biomedical Library (Louise M. Darling)"
      Then I should be on "/biomed"
      Given I follow "Key Resources"
      Then I should be on "/biomed/key-resources"

    Scenario: #1C
      Given I fill in "Site Search" with "Biomedical Library Key Resources"
      And I click the "#submit" element
      Then I should be on "/site-search?search_query=Biomedical+Library+key+resources"
      Given I follow "Key Resources"
      Then I should be on "/biomed/key-resources"
