Feature: Searching the Film & TV Catalog
	Background:
		Given I go to [/home]

	Scenario: 1A
	Then I follow [/search_link]
	Then the url should match [/search_url]
	Then I follow [/search/filmtelevision_link]
	Then the url should match [/resguide_url]
	Then I follow [/resguide/catalog_link]
	Then the url should match [/booksbasicsearch_link]

	Scenario: 1B
	Then I follow [/search_link]
	Then the url should match [/search_url]
	Then I follow [/search/libcatalog_link]
	Then the url should match [/sitesearch/descriptionlibrarycatalog_url]
	Then I follow [/search/filmtelevisioncatalog_link]
	Then the url should match [/booksbasicsearch_link]

	Scenario: 1C
	Then I fill in [/sitesearch_text] with [/sitesearchresult_search:”Film & TV Catalog”]
	Then I click the [/submit_element] element
	Then the url should match [/sitesearch_url]
	Then I follow [/sitesearch/descriptionlibrarycatalog_link]
	Then the url should match [/sitesearch/descriptionlibrarycatalog_url]
	Then I follow [/search/filmtelevisioncatalog_link]
	Then the url should match [/booksbasicsearch_link]
