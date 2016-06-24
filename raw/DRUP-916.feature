Feature: Getting Information About the Libraries
  In order to get information about all libraries
  As an anonymous user
  I should check that these links are valid from all paths

  Background:
    Given I go to "https://WWW.library.ucla.edu"

    Scenario: #1A
      Given I follow "Arts Library"
      Then I should be on "/arts"

    Scenario: #1B
      Given I fill in "Site Search" with "Arts Library"
      And I click the "#submit" element
      Then I should be on "/site-search?search_query=Arts+Library"
      Given I follow "Arts Library"
      Then I should be on "/arts"

    Scenario: #1C
      Given I follow "Locations"
      Then I should be on "/locations"
      Given I follow "Arts Library"
      Then I should be on "/arts"

    Scenario: #1D
      Given I follow "Hours"
      Then I should be on "/hours"
      Given I follow "Arts Library"
      Then I should be on "/arts"

    Scenario: #1E
      Given I follow "Biomedical Library (Louise M. Darling)"
      Then I should be on "/biomed"

    Scenario: #1F
      Given I fill in "Site Search" with "Biomed"
      And I click the "#submit" element
      Then I should be on "/site-search?search_query=biomed"
      Given I follow "Biomedical Library (Louise M. Darling)"
      Then I should be on "/biomed"

    Scenario:  #1G
      Given I follow "Locations"
      Then I should be on "/locations"
      Given I follow "Biomedical Library (Louise M. Darling)"
      Then I should be on "/biomed"

    Scenario: #1H
      Given I follow "Hours"
      Then I should be on "/hours"
      Given I follow "Biomedical Library (Louise M. Darling)"
      Then I should be on "/biomed"

    Scenario: #1I
      Given I follow "Powell Library"
      Then I should be on "/powell"

    Scenario: #1J
      Given I fill in "Site Search" with "Powell"
      And I click the "#submit" element
      Then I should be on "/site-search?search_query=Powell"
      Given I follow "Powell Library"
      Then I should be on "/powell"

    Scenario: #1K
      Given I follow "Locations"
      Then I should be on "/locations"
      Given I follow "Powell Library"
      Then I should be on "/powell"

    Scenario: #1L
      Given I follow "Locations"
      Then I should be on "/locations"
      Given I fill in "" with "Powell Library"
      And I click the "#edit-submit-location-search" element
      Then I should be on "/locations?search_api_views_fulltext=Powell+Library&=Apply"
      Given I follow "Powell Library"
      Then I should be on "/powell"

    Scenario: #1M
      Given I follow "Hours"
      Then I should be on "/hours"
      Given I follow "Powell Library"
      Then I should be on "/powell"

    Scenario: #1N
      Given I follow "Research Library (Charles E. Young)"
      Then I should be on "/yrl"

    Scenario: #1O
      Given I fill in "Site Search" with "YRL"
      And I click the "#submit" element
      Then I should be on "/site-search?search_query=YRL"
      Given I follow "Research Library (Charles E. Young)"
      Then I should be on "/yrl"

    Scenario: #1P
      Given I follow "Locations"
      Then I should be on "/locations"
      Given I follow "Research Library (Charles E. Young)"
      Then I should be on "/yrl"

     Scenario: #1Q
       Given I follow "Locations"
       Then I should be on "/locations"
       Given I fill in "" with "YRL"
       Then I should be on "/locations?search_api_views_fulltext=yrl&=Apply"
       Given I follow "Research Library (Charles E. Young)"
       Then I should be on "/yrl"

     Scenario: #1R
       Given I follow "Hours"
       Then I should be on "/hours"
       Given I follow "Research Library (Charles E. Young)"
       Then I should be on "/yrl"

     Scenario: #1S
       Given I follow "Music Library"
       Then I should be on "/music"

     Scenario: #1T
       Given I fill in "Site Search" with "Music Library"
       And I click the "#submit" element
       Then I should be on "/site-search?search_query=Music+Library"
       Given I follow "Music Library"
       Then I should be on "/music"

     Scenario: #1U
       Given I follow "Locations"
       Then I should be on "/locations"
       Given I follow "Libraries Only"
       Then I should be on "/locations?f[0]=type%3Alocation"
       Given I follow "Music Library"
       Then I should be on "/music"

     Scenario: #1V
       Given I follow "Locations"
       Then I should be on "/locations"
       Given I fill in "" with "Music Library"
       And I click the "#edit-submit-location-search" element
       Then I should be on "/locations?search_api_views_fulltext=Music+Library&=Apply"
       Given I follow "Music Library"
       Then I should be on "/music"

     Scenario: #1W
       Given I follow "Hours"
       Then I should be on "/hours"
       Given I follow "Music Library"
       Then I should be on "/music"

     Scenario: #1X
       Given I follow "Science and Engineering Library"
       Then I should be on "/sel"

     Scenario: #1Y
       Given I fill in "Site Search" with "Boelter Library"
       And I click the "#submit" element
       Then I should be on "site-search?search_query=Boelter+Library"
       Given I follow "Science and Engineering Library"
       Then I should be on "/sel"

     Scenario: #1Z
       Given I follow "Locations"
       Then I should be on "/locations"
       Given I follow "Science and Engineering Library"
       Then I should be on "/sel"

     Scenario: #2A
       Given I follow "Locations"
       Then I should be on "/locations"
       Given I fill in "" with "Boelter Library"
       And I click the "#edit-submit-location-search" element
       Then I should be on "/locations?search_api_views_fulltext=Boelter&=Apply"
       Given I follow "Science and Engineering Library"
       Then I should be on "/sel"

     Scenario: #2B
       Given I follow "Hours"
       Then I should be on "/hours"
       Given I follow "Science and Engineering Library"
       Then I should be on "/sel"

     Scenario: #2C
       Given I follow "Law Library (Hugh & Hazel Darling)"
       Then I should be on "/law"

     Scenario: #2D
       Given I fill in "Site Search" with "Law Library"
       And I click the "#submit" element
       Then I should be on "/site-search?search_query=law+library"
       Given I follow "Law Library (Hugh & Hazel Darling)"
       Then I should be on "/law"

     Scenario: #2E
       Given I follow "Locations"
       Then I should be on "/locations"
       Given I follow "Law Library (Hugh & Hazel Darling)"
       Then I should be on "/law"

     Scenario: #2F
       Given I follow "Locations"
       Then I should be on "/locations"
       Given I fill in "" with "Law Library"
       And I click the "#edit-submit-location-search" element
       Then I should be on "/locations?search_api_views_fulltext=law+library"

     Scenario: #2G
       Given I follow "Hours"
       Then I should be on "/hours"
       Given I follow "Law Library (Hugh & Hazel Darling)"
       Then I should be on "/law"
