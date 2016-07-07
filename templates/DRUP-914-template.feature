Feature: CLICC Study Room Reservation
In order to find CLICC Study Room Reservation on the library website
As an anonymous user
I need to check that all links are valid from different paths

Background:
  Given I go to [/home]

@clicc @services @rooms
Scenario: #1A
  Given I follow [/clicc_link]
  Then I should be on [/clicc_url]
  Given I follow [/clicc/studyrooms_link]
  Then I should be on [/clicc/studyrooms_url]

@clicc @services @rooms
Scenario: #1B
  Given I follow [/clicc_link]
  Then I should be on [/clicc_url]
  Given I follow [/clicc/reserve_link]
  Then I should be on [/clicc/studyrooms_url]

@search @css @clicc @topic @rooms
Scenario: #1C
  Given I fill in [/sitesearch_text] with [/sitesearchresult_search:”study rooms”]
  And I click the [/submit_element] element
  Then I should be on [/sitesearchresult_query:”study rooms”]
  Given I follow [/clicc/studyrooms_link]
  Then I should be on [/clicc/studyrooms_url]

@locations @powell @rooms @services
Scenario: #1D
  Given I follow [/gsr_link]
  Then I should be on [/gsr_url]
  Given I follow [/powlib_link]
  Then I should be on [/powlib_url]
  Given I follow [/clicc/studyrooms_link]
  Then I should be on [/clicc/studyrooms_url]

@locations @yrl @rooms @gsr @pod
Scenario: #1E
  Given I follow [/gsr_link]
  Then I should be on [/gsr_url]
  Given I follow [/reslib_link]
  Then I should be on [/reslib_url]
  Given I follow [/yrl/reserve_link]
  Then I should be on [/clicc/studyrooms_url]

@clicc @pod @locations @powell @rooms
Scenario: #1F
  Given I follow [/pod_link]
  Then I should be on [/pod_url]
  Given I follow [/powlib_link]
  Then I should be on [/powlib_url]
  Given I follow [/clicc/studyrooms_link]
  Then I should be on [/clicc/studyrooms_url]

@clicc @pod @locations @yrl @rooms
Scenario: #1G
  Given I follow [/pod_link]
  Then I should be on [/pod_url]
  Given I follow [/reslib_link]
  Then I should be on [/reslib_url]
  Given I follow [/yrl/reserve_link]
  Then I should be on [/clicc/studyrooms_url]

@powell @rooms @locations @clicc
Scenario: #1H
  Given I follow [/powlib_link]
  Then I should be on [/powlib_url]
  Given I follow [/clicc/studyrooms_link]
  Then I should be on [/clicc/studyrooms_url]

@yrl @locations @rooms @pod @clicc
Scenario: #1I
  Given I follow [/reslib_link]
  Then I should be on [/reslib_url]
  Given I follow [/yrl/reserve_link]
  Then I should be on [/clicc/studyrooms_url]

@clicc @lending @powell @locations @rooms
Scenario: #1J
  Given I follow [/lending_link]
  Then I should be on [/lending_url]
  Given I follow [/powlib_link]
  Then I should be on [/powlib_url]
  Given I follow [/clicc/studyrooms_link]
  Then I should be on [/clicc/studyrooms_url]

@locations @yrl @pod @clicc @lending
Scenario: #1K
  Given I follow [/lending_link]
  Then I should be on [/lending_url]
  Given I follow [/reslib_link]
  Then I should be on [/reslib_url]
  Given I follow [/yrl/reserve_link]
  Then I should be on [/clicc/studyrooms_url]

@locations @clicc @lending @yrl @rooms
Scenario: #1L
  Given I follow [/lending_link]
  Then I should be on [/lending_url]
  Given I follow [/reslib_link]
  Then I should be on [/destination/rc_url]
  Given I follow [/destination/rcstudyrooms_link]
  Then I should be on [/clicc/studyrooms_url]

@hompeage @navbar @rooms @clicc @gsr
Scenario: #1M
  Given I follow [/support_link]
  Then I should be on [/support_url]
  Given I follow [/support/students_link]
  Then I should be on [/support/students_url]
  Given I follow [/support/study_link]
  Then I should be on [/support/study_url]
  Given I follow [/gsr_link]
  Then I should be on [/clicc/studyrooms_url]

@homepage @navbar @clicc @rooms @gsr @services
  Scenario: #1N
  Given I follow [/support_link]
  Then I should be on [/support_url]
  Given I follow [/support/laptops_link]
  Then I should be on [/clicc_url]
  Given I follow [/clicc/studyrooms_link]
  Then I should be on [/clicc/studyrooms_url]

@homepage @navbar @clicc @gsr @rooms
Scenario: #1O
  Given I follow [/use_link]
  Then I should be on [/use_url]
  Given I follow [/use/study_link]
  Then I should be on [/use/study_url]
  Given I follow [/gsr_link]
  Then I should be on [/clicc/studyrooms_url]

@homepage @navbar @clicc @gsr @rooms
Scenario: #1P
  Given I follow [/use_link]
  Then I should be on [/use_url]
  Given I follow [/use/laptopslabclassrooms_link]
  Then I should be on [/sitesearchresult_search:”clicc”]
  Given I follow [/clicc/studyrooms_link]
  Then I should be on [/clicc/studyrooms_url]
