Feature: Navigating the Library
	Background:
		Given I go to [/home]

	Scenario: 1A
	Then I follow [/search_link]
	Then the url should match [/search_url]

	Scenario: 1B
	Then I follow [/search/researchandteaching_link]
	Then the url should match [/support_url]

	Scenario: 1C
	Then I follow [/locations_link]
	Then the url should match [/equip_link]

	Scenario: 1D
	Then I follow [/use_link]
	Then the url should match [/use_url]
