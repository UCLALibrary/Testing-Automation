Feature: Navigating the Library
	Background:
		Given I go to [/home]

	@homepage @navbar
	Scenario: 1A
	Then I follow [/search_link]
	Then the url should match [/search_url]

    @homepage @navbar
	Scenario: 1B
	Then I follow [/search/researchandteaching_link]
	Then the url should match [/support_url]

    @homepage @navbar
	Scenario: 1C
	Then I follow [/locations_link]
	Then the url should match [/equip_link]

    @homepage @navbar
	Scenario: 1D
	Then I follow [/use_link]
	Then the url should match [/use_url]
