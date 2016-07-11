Feature: CLICC Software List
	Background:
		Given I go to [/home]

	Scenario:1A
	Then I follow [/clicc_link]
	Then the url should match [/clicc_url]
	Then I follow [/clicc/software_link]
	Then the url should match [/clicc/software_url]

	Scenario:1B
	Then I fill in [/sitesearch_text] with [/sitesearchresult_search:”CLICC Software”]
	Then I click the [/submit_element] element
	Then the url should match [/sitesearch_url]
	Then I follow [/clicc/software_link]
	Then the url should match [/clicc/software_url]

	Scenario:1C
	Then I follow [/powlib_link]
	Then the url should match [/powlib_url]
	Then I follow [/powell/computerlab_link]
	Then the url should match [/powell/computerlab_url]
	Then I follow [/powell/clicc]
	Then the url should match [/clicc_url]
	Then I follow [/clicc/software_link]
	Then the url should match [/clicc/software_url]

	Scenario:1D
	Then I follow [/powlib_link]
	Then the url should match [/powlib_url]
	Then I follow [/powell/lending_link]
	Then the url should match [/powell/lending_url]
	Then I follow [/clicc/softwarelist_link]
	Then the url should match [/clicc/software_url]

	Scenario:1E
	Then I follow [/reslib_link]
	Then the url should match [/reslib_url]
	Then I follow [/yrl/lending_link]
	Then the url should match [/yrl/lending_url]
	Then I follow [/clicc/softwarelist_link]
	Then the url should match [/clicc/software_url]

	Scenario:1F
	Then I follow [/support_link]
	Then the url should match [/support_url]
	Then I follow [/support/laptops_link]
	Then the url should match [/clicc_url]
	Then I follow [/clicc/software_link]
	Then the url should match [/clicc/software_url]

	Scenario:1G
	Then I follow [/use_link]
	Then the url should match [/use_url]
	Then I follow [/use/laptops_link]
	Then the url should match [/clicc_url]
	Then I follow [/clicc/software_link]
	Then the url should match [/clicc/software_url]

	#Scenario:1H
	#Then I follow [/locations_link]
	#Then the url should match [/equip_link]
	#Then I follow [/clicc/equip_link]
	#Then I check the box [/clicc/comp_filter]
	#Then the url should match [/equip_link]
	#Then I follow [/powlib_link]
	#Then the url should match [/powlib_url]
	#Then I follow [/powell/lending_link]
	#Then the url should match [/powell/lending_url]
