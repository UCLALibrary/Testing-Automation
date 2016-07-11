Feature: CLICC Software List
	Background:
		Given I go to "http://library.ucla.edu"

	Scenario:1A
	Then I follow "Use CLICC Laptops and Services"
	Then the url should match "/clicc"
	Then I follow "Software"
	Then the url should match "/clicc/software"

	Scenario:1B
	Then I fill in "Site Search" with "CLICC Software"
	Then I click the "#submit" element
	Then the url should match "/site-search"
	Then I follow "Software"
	Then the url should match "/clicc/software"

	Scenario:1C
	Then I follow "Powell Library"
	Then the url should match "/powell"
	Then I follow "CLICC Computer Lab"
	Then the url should match "/powell/clicc-computer-lab"
	Then I follow "CLICC"
	Then the url should match "/clicc"
	Then I follow "Software"
	Then the url should match "/clicc/software"

	Scenario:1D
	Then I follow "Powell Library"
	Then the url should match "/powell"
	Then I follow "CLICC Laptop Lending (Powell Library)"
	Then the url should match "/powell/clicc-laptop-lending-powell-library"
	Then I follow "CLICC Software List"
	Then the url should match "/clicc/software"

	Scenario:1E
	Then I follow "Research Library (Charles E. Young)"
	Then the url should match "/yrl"
	Then I follow "CLICC Laptop Lending (Research Library)"
	Then the url should match "/yrl/clicc-laptop-lending-research-library"
	Then I follow "CLICC Software List"
	Then the url should match "/clicc/software"

	Scenario:1F
	Then I follow "Research & Teaching Support"
	Then the url should match "/support"
	Then I follow "CLICC Laptops and Services"
	Then the url should match "/clicc"
	Then I follow "Software"
	Then the url should match "/clicc/software"

	Scenario:1G
	Then I follow "Using the Library"
	Then the url should match "/use"
	Then I follow "CLICC Laptops & Services"
	Then the url should match "/clicc"
	Then I follow "Software"
	Then the url should match "/clicc/software"

	#Scenario:1H
	#Then I follow "Locations"
	#Then the url should match "/locations"
	#Then I follow "Equipment"
	#Then I check the box "Computers (CLICC)"
	#Then the url should match "/locations"
	#Then I follow "Powell Library"
	#Then the url should match "/powell"
	#Then I follow "CLICC Laptop Lending (Powell Library)"
	#Then the url should match "/powell/clicc-laptop-lending-powell-library"
