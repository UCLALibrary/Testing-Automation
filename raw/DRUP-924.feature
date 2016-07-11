Feature: Information About Student Jobs at the Library
  In order to find information about student jobs at the library
  As an anonymous user
  I need to verify that the link is valid through different paths

Background:
  Given I go to "https://www.library.ucla.edu"

@homepage @footer @misc @employment
Scenario: #1A
  Given I follow "Employment"
  Then I should be on "/about/employment-human-resources"
  Given I follow "Student Positions"
  Then I should be on "/about/employment-human-resources/ucla-library-jobs-students"

@homepage @navbar @misc @employment
Scenario: #1B
  Given I follow "Research & Teaching Support"
  Then I should be on "/support"
  Given I follow "Support for Students"
  Then I should be on "/support/students"
  Given I follow "Apply for a Student Job at the Library"
  Then I should be on "/about/employment-human-resources/ucla-library-jobs-students"

@search @topic @css @misc @employment
Scenario: #1C
  Given I fill in "Site Search" with "student jobs"
  And I click the "#submit" element
  Then I should be on "/site-search?search_query=student+jobs"
  Given I follow "UCLA Library Jobs for Students"
  Then I should be on "/about/employment-human-resources/ucla-library-jobs-students"
