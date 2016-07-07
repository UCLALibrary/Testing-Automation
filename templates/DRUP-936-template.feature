Feature: Find Video on UCLA Library Website
  To find a video on the library website
  As an anonymous user
  I need to verify that the link works from all paths

  Background:
    Given I go to [/home]

    @search @css @page @video
    Scenario: #1A
      Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”Research Data Matters”]
      And I click the [/submit_element] element
      Then I should be on [/sitesearchresult_query:”Research Data Matters”]
      Given I follow [/news/researchvideo_link]
      Then I should be on [/news/researchvideo_url]
      Given the element [/news/researchvideo_element] exists
      Then I should see [/news/researchvideo_text]
