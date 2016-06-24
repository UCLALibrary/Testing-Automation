Feature: Searching the Film & TV Catalog
	Background:
		Given I go to "http://library.ucla.edu"

	Scenario: 1A
	Then I follow "Search"
	Then the url should match "/search"
	Then I follow "UCLA Film & Television Archive"
	Then the url should match "/"
	Then I follow "Catalog"
	Then the url should match "/vwebv/searchBasic"

	Scenario: 1B
	Then I follow "Search"
	Then the url should match "/search"
	Then I follow "Description of Library Catalog"
	Then the url should match "/search/description-library-catalogs"
	Then I follow "UCLA Film & Television Archive Catalog"
	Then the url should match "/vwebv/searchBasic"

	Scenario: 1C
	Then I fill in "Site Search" with "Film & TV Catalog"
	Then I click the "#submit" element
	Then the url should match "/site-search"
	Then I follow "Description of Library Catalogs"
	Then the url should match "/search/description-library-catalogs"
	Then I follow "UCLA Film & Television Archive Catalog"
	Then the url should match "/vwebv/searchBasic"
