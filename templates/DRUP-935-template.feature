Feature: Find Map of All Libraries
  In order to find map of all libraries
  As an anonymous user
  I need to verify that these links work on various paths

  Background:
    Given I go to [/home]

    Scenario: #1A
      Given I follow [/locations_link]
      Then I should be on [/equip_link]
      Given I follow [/librariesmap_link]
      Then I should be on [/librariesmap_url]

    Scenario: #1B
      Given I follow [/gsr_link]
      Then I should be on [/gsr_url]
      Given I follow [/librariesmap_link]
      Then I should be on [/librariesmap_url]

    Scenario: #1C
      Given I follow [/pod_link]
      Then I should be on [/pod_url]
      Given I follow [/librariesmap_link]
      Then I should be on [/librariesmap_url]
