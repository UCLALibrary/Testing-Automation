Feature: Find Night Powell Hours on the library website.

  @javascript
    Scenario: 1A
      Given I go to "http://www.library.ucla.edu"
      And I click on the link "Powell Library"
      Then the url should match "/powell"
      And I click on the link "Night Powell"
      Then the url should match "night-powell"

    Scenario: 1B
      Then I go to "http://www.library.ucla.edu"
      And I click on the link "Powell Library"
      Then the url should match "/powell"
      And I click on the link "At This Location"
      Then the url should match "/powell/at-this-location"

    Scenario: 1C
      Then I go to "http://www.library.ucla.edu"
      And I fill in "Site Search" with "night powell"
      Then I click the "#submit" element
      Then the url should match "site-search"
      And I follow "Night Powell"
      Then the url should match "/destination/night-powell"

    Scenario: 1D
      Then I go to "http://www.library.ucla.edu"
      And I fill in "Site Search" with "night powell"
      Then I click the "#submit" element
      Then the url should match "/site-search"
      And I follow "Powell Library"
      And the url should match "/powell"
      Then I follow "Night Powell"
      And the url should match "/destination/night-powell"

    Scenario: 1E
      Then I go to "http://www.library.ucla.edu"
      And I fill in "Site Search" with "night powell"
      Then I click the "#submit" element
      Then the url should match "/site-search"
      Then I click on the link "Powell Library"
      Then the url should match "/powell"
      Then I click on the link "At This Location"
      Then the url should match "/powell/at-this-location"