Feature: Navigating the Library
	Background:
		Given I go to "https://www.library.ucla.edu"

	@homepage @navbar
	Scenario: 1A
	Then I follow "Search"
	Then the url should match "/search"

    @homepage @navbar
	Scenario: 1B
	Then I follow "Research & Teaching"
	Then the url should match "/support"

    @homepage @navbar
	Scenario: 1C
	Then I follow "Locations"
	Then the url should match "/locations"

    @homepage @navbar
	Scenario: 1D
	Then I follow "Using the Library"
	Then the url should match "/use"
