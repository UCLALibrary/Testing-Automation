Feature: Accessing Digital Collections
	Background: 
		Given I go to "http://library.ucla.edu"

	Scenario:1A
	Then I follow "UCLA Digital Collections"
	Then the url should match "/"

	Scenario:1B
	Then I follow "Search"
	Then the url should match "/search"
	Then I follow "UCLA Library Digital Collections"
	Then the url should match "/"

	Scenario:1C
	Then I fill in "Site Search" with "Digital Collections"
	Then I click the "#submit" element
	Then the url should match "/site-search"
	Then I follow "UCLA Library Digital Collections"
	Then the url should match "/about/about-collections/ucla-library-digital-collections"
	Then I follow "UCLA Digital Collections"
	Then the url should match "/"