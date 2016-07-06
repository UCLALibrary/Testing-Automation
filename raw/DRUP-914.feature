Feature: CLICC Study Room Reservation
In order to find CLICC Study Room Reservation on the library website
As an anonymous user
I need to check that all links are valid from different paths

Background:
  Given I go to "https://www.library.ucla.edu"

@clicc @services @rooms
Scenario: #1A
  Given I follow "Use CLICC Laptops and Services"
  Then I should be on "/clicc"
  Given I follow "Study Room Services"
  Then I should be on "/clicc/study-rooms"

@clicc @services @rooms
Scenario: #1B
  Given I follow "Use CLICC Laptops and Services"
  Then I should be on "/clicc"
  Given I follow "Reserve Study Spaces"
  Then I should be on "/clicc/study-rooms"

@search @css @clicc @topic @rooms
Scenario: #1C
  Given I fill in "Site Search" with "study rooms"
  And I click the "#submit" element
  Then I should be on "/site-search?search_query=study+rooms"
  Given I follow "Study Rooms"
  Then I should be on "/clicc/study-rooms"

@locations @powell @rooms @services
Scenario: #1D
  Given I follow "Find a Group Study Room"
  Then I should be on "/locations?f%5B0%5D=field_study_areas%3A36"
  Given I follow "Powell Library"
  Then I should be on "/powell"
  Given I follow "Study Room Services"
  Then I should be on "/clicc/study-rooms"

@locations @yrl @rooms @gsr @pod
Scenario: #1E
  Given I follow "Find a Group Study Room"
  Then I should be on "/locations?f%5B0%5D=field_study_areas%3A36"
  Given I follow "Research Library (Charles E. Young)"
  Then I should be on "/yrl"
  Given I follow "Reserve a Room or Pod"
  Then I should be on "/clicc/study-rooms"

@clicc @pod @locations @powell @rooms
Scenario: #1F
  Given I follow "Find a Collaboration Pod"
  Then I should be on "/locations?f%5B0%5D=field_study_areas%3A41"
  Given I follow "Powell Library"
  Then I should be on "/powell"
  Given I follow "Study Room Services"
  Then I should be on "/clicc/study-rooms"

@clicc @pod @locations @yrl @rooms
Scenario: #1G
  Given I follow "Find a Collaboration Pod"
  Then I should be on "/locations?f%5B0%5D=field_study_areas%3A41"
  Given I follow "Research Library (Charles E. Young)"
  Then I should be on "/yrl"
  Given I follow "Reserve a Room or Pod"
  Then I should be on "/clicc/study-rooms"

@powell @rooms @locations @clicc
Scenario: #1H
  Given I follow "Powell Library"
  Then I should be on "/powell"
  Given I follow "Study Room Services"
  Then I should be on "/clicc/study-rooms"

@yrl @locations @rooms @pod @clicc
Scenario: #1I
  Given I follow "Research Library (Charles E. Young)"
  Then I should be on "/yrl"
  Given I follow "Reserve a Room or Pod"
  Then I should be on "/clicc/study-rooms"

@clicc @lending @powell @locations @rooms
Scenario: #1J
  Given I follow "Laptop Lending (CLICC)"
  Then I should be on "/locations?f[0]=field_equipment%3A100"
  Given I follow "Powell Library"
  Then I should be on "/powell"
  Given I follow "Study Room Services"
  Then I should be on "/clicc/study-rooms"

@locations @yrl @pod @clicc @lending
Scenario: #1K
  Given I follow "Laptop Lending (CLICC)"
  Then I should be on "/locations?f[0]=field_equipment%3A100"
  Given I follow "Research Library (Charles E. Young)"
  Then I should be on "/yrl"
  Given I follow "Reserve a Room or Pod"
  Then I should be on "/clicc/study-rooms"

@locations @clicc @lending @yrl @rooms
Scenario: #1L
  Given I follow "Laptop Lending (CLICC)"
  Then I should be on "/locations?f[0]=field_equipment%3A100"
  Given I follow "Research Library (Charles E. Young)"
  Then I should be on "/destination/research-commons"
  Given I follow "More group study rooms on campus"
  Then I should be on "/clicc/study-rooms"

@hompeage @navbar @rooms @clicc @gsr
Scenario: #1M
  Given I follow "Research & Teaching Support"
  Then I should be on "/support"
  Given I follow "Support for Students"
  Then I should be on "/support/students"
  Given I follow "Find Places to Study and Collaborate"
  Then I should be on "/support/support-students/find-places-study-collaborate"
  Given I follow "Group Study Rooms"
  Then I should be on "/clicc/study-rooms"

@homepage @navbar @clicc @rooms @gsr @services
  Scenario: #1N
  Given I follow "Research & Teaching Support"
  Then I should be on "/support"
  Given I follow "CLICC Laptops and Services"
  Then I should be on "/clicc"
  Given I follow "Study Room Services"
  Then I should be on "/clicc/study-rooms"

@homepage @navbar @clicc @gsr @rooms
Scenario: #1O
  Given I follow "Using the Library"
  Then I should be on "/use"
  Given I follow "Study and Learning Spaces"
  Then I should be on "/use/access-privileges/study-learning-spaces"
  Given I follow "Group Study Rooms"
  Then I should be on "/clicc/study-rooms"

@homepage @navbar @clicc @gsr @rooms
Scenario: #1P
  Given I follow "Using the Library"
  Then I should be on "/use"
  Given I follow "CLICC Laptops, Lab and Classrooms"
  Then I should be on "clicc"
  Given I follow "Study Room Services"
  Then I should be on "/clicc/study-rooms"
