Feature: Find Video on UCLA Library Website
  To find a video on the library website
  As an anonymous user
  I need to verify that the link works from all paths

  Background:
    Given I go to "https://www.library.ucla.edu"

    @search @css @page @video
    Scenario: #1A
      Given I fill in "Site Search" with "Research Data Matters"
      And I click the "#submit" element
      Then I should be on "/site-search?search_query=Research+Data+Matters"
      Given I follow "Research Data Matters video"
      Then I should be on "/news/research-data-matters-video"
      Given the element "iframe" exists
      Then I should see "Viewers are encouraged to complete a brief feedback survey"