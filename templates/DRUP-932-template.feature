Feature: Access Library Guides
	Background:
		Given I go to [/home]

	Scenario:1A
	Then I go to [/researchguides_url]
	Then I follow [/resguide/browse_link]
	Then I should be on [/resguide_url]

	Scenario:1B
	Then I follow [/search_link]
	Then I should be on [/search_url]
	Then I follow [/researchguides_link]
	Then I should be on [/resguide_url]

	Scenario:1C
	Then I follow [/search_link]
	Then I should be on [/search_url]
	Then I go to [/guides_url]
	Then I should be on [/resguide_url]

	Scenario:1D
	Then I follow [/resguide_link]
	Then I should be on [/resguide_url]

	Scenario:1E
	Then I fill in [/sitesearch_text] with [/researchguides_link]
	Then I click the [/submit_element] element
	Then I should be on [/sitesearchresult_query:”resguide”]
	Then I follow [/researchguides_link]
	Then I should be on [/researchguides_url]
	Then I follow [/afam_link]
	Then I should be on [/afam_url]
	Then I follow [/uclalib_link]
	Then I should be on [/resguide_url]
	Then I go to [/researchguides_url]
	Then I should be on [/resguide_url]
	Then I follow [/resguide/browse_link]
	Then I should be on [/resguide_url]

	Scenario:1F
	Then I fill in [/sitesearch_text] with [/sitesearchresult_search:”Online Research Guide”]
	Then I click the [/submit_element] element
	Then I should be on [/sitesearchresult_query:”Online Research Guide”]
	Then I follow [/sitesearchresult_link:”Online Research Guide”]
	Then I should be on [/sitesearchresult_url:”Online Research Guide”]
	Then I follow [/onlineresguide_link]
	Then I should be on [/resguide_url]
