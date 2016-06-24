Feature: Access Library Guides
	Background:
		Given I go to "http://library.ucla.edu"

	Scenario:1A
	Then I go to "/#guides"
	Then I follow "Browse All Research Guides"
	Then I should be on "/"

	Scenario:1B
	Then I follow "Search"
	Then I should be on "/search"
	Then I follow "Research Guides"
	Then I should be on "/"

	Scenario:1C
	Then I follow "Search"
	Then I should be on "/search"
	Then I go to "http://guides.library.ucla.edu"
	Then I should be on "/"

	Scenario:1D
	Then I follow "Find a Research Guide"
	Then I should be on "/"

	Scenario:1E
	Then I fill in "Site Search" with "Research Guides"
	Then I click the "#submit" element
	Then I should be on "/site-search?search_query=research+guides"
	Then I follow "Research Guides"
	Then I should be on "/special-collections/discover-collections/research-guides"
	Then I follow "African American Studies"
	Then I should be on "/library-special-collections/african-american-studies"
	Then I follow "UCLA Library"
	Then I should be on "/"
	Then I go to "/#guides"
	Then I should be on "/"
	Then I follow "Browse All Research Guides"
	Then I should be on "/"

	Scenario:1F
	Then I fill in "Site Search" with "Online Research Guide"
	Then I click the "#submit" element
	Then I should be on "/site-search?search_query=online+research+guide"
	Then I follow "Library Research Guides Updated"
	Then I should be on "/news/library-research-guides-updated"
	Then I follow "online research guides"
	Then I should be on "/"