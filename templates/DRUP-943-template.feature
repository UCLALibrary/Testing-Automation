Feature: CLICC Resources Part II
  In order to find CLICC Resources
  As an anonymous user
  I need to verify that these links work from different paths

  Background:
    Given I go to [/home]

    @clicc @computerlab
    Scenario: #1A
      Then I follow [/clicc_link]
      Then I should be on [/clicc_url]
      Then I follow [/powell/computerlab_link]
      Then I should be on [/powell/computerlab_url]

    @clicc @classrooms
    Scenario: #1B
      Then I follow [/clicc_link]
      Then I should be on [/clicc_url]
      Then I follow [/clicc/cliccclassrooms_link]
      Then I should be on [/clicc/cliccclassrooms_url]

    @clicc @printers @scanners
    Scenario: #1C
      Then I follow [/clicc_link]
      Then I should be on [/clicc_url]
      Then I follow [/clicc/printersscanners_link]
      Then I should be on [/clicc/printersscanners_url]

    @clicc @lending
    Scenario: #1D
      Then I follow [/clicc_link]
      Then I should be on [/clicc_url]
      Then I follow [/clicc/laptopsmore_link]
      Then I should be on [/clicc/laptopsmore_url]
