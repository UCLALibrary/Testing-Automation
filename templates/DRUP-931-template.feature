Feature: Accessing Digital Collections
	Background: 
		Given I go to [/home]

	Scenario:1A
	Then I follow [/resguide_link]
	Then the url should match [/resguide_url]

	Scenario:1B
	Then I follow [/search_link]
	Then the url should match [/search_url]
	Then I follow [/sitesearchresult_link:”Digital Collections”]
	Then the url should match [/resguide_url]

	Scenario:1C
	Then I fill in [/sitesearch_text] with [/sitesearchresult_search:”Digital Collections”]
	Then I click the [/submit_element] element
	Then the url should match [/sitesearch_url]
	Then I follow [/sitesearchresult_link:”Digital Collections”]
	Then the url should match [/about/resguide_url]
	Then I follow [/resguide_link]
	Then the url should match [/resguide_url]
