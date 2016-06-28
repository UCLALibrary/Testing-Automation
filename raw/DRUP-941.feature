Feature: Accessing Journals
  In order to access journals
  As an anonymous user
  I need to verify that these links work from different paths

  Background:
    Given I go to "https://www.library.ucla.edu"

    @javascript
    Scenario: #1A
      Given I follow "Journals"
      Then I should be on "/#journals"
      Then I follow "A-Z Journal Titles"
      Then I switch to the next window
      And wait 2 second
      Then I should be on "/sfx_ucla/az/default?&param_sid_save=e21718f6c370481f02f52709928f7941&param_lang_save=eng&param_letter_group_save=A&param_perform_save=searchCategories&param_letter_group_script_save=Latin&param_chinese_checkbox_save=0&param_services2filter_save=getFullTxt&param_services2filter_save=getSelectedFullTxt&param_current_view_save=table&param_pattern_save=&param_jumpToPage_save=&param_type_save=browseLetterGroup&param_textSearchType_save=startsWith&&param_perform_value=searchTitle"

    Scenario: #1B
      Given I follow "Search"
      Then I should be on "/search"
      Then I follow "Find e-journals"
      Then I should be on "/sfx_ucla/az"

    Scenario: #1C
      Given I fill in "Site Search" with "Journals"
      And I click the "#submit" element
      Then I should be on "/site-search?search_query=journals"
      Then I follow "Journal Articles and Conference Papers"
      Then I should be on "/location/science-engineering-library/key-resources/journal-articles-conference-papers"
      Then I follow "E-Journals in Science and Engineering"
      Then I should be on "/sfx_ucla/az/default?param_sid_save=2e0d461ec429331b2922a9477f072af2&param_locate_category_save=6&param_locate_category_save=8&param_locate_category_save=7&param_locate_category_save=3&param_locate_category_save=5&param_locate_category_save=1&param_locate_category_save=9&param_locate_category_save=12&param_locate_category_save=4&param_locate_category_save=10&param_locate_category_save=17&param_locate_category_save=15&param_lang_save=eng&param_letter_group_save=&param_perform_save=locate&param_letter_group_script_save=&param_issn_save=&param_chinese_checkbox_save=0&param_services2filter_save=getFullTxt&param_services2filter_save=getSelectedFullTxt&param_current_view_save=table&param_pattern_save=sci*&param_jumpToPage_save=&param_type_save=textSearch&param_textSearchType_save=startsWith&param_vendor_save=&param_jumpToPage_value=&param_pattern_value=&param_textSearchType_value=startsWith&param_issn_value=&param_vendor_active=1&param_locate_category_active=1&param_locate_category_value=6&param_locate_category_value=8&param_locate_category_value=7&param_locate_category_value=3&param_locate_category_value=5&param_locate_category_value=1&param_locate_category_value=9&param_locate_category_value=12&param_locate_category_value=4&param_locate_category_value=10&param_locate_category_value=17&param_locate_category_value=15"
      Then I follow "Title"
      Then I should be on "/sfx_ucla/az/default?&param_sid_save=700b7081ba06eaf51cc5f0c095d38402&param_letter_group_script_save=&param_issn_save=&param_current_view_save=table&param_textSearchType_save=startsWith&param_locate_category_save=6&param_locate_category_save=8&param_locate_category_save=7&param_locate_category_save=3&param_locate_category_save=5&param_locate_category_save=1&param_locate_category_save=9&param_locate_category_save=12&param_locate_category_save=4&param_locate_category_save=10&param_locate_category_save=17&param_locate_category_save=15&param_lang_save=eng&param_chinese_checkbox_type_save=Pinyin&param_perform_save=locate&param_letter_group_save=&param_chinese_checkbox_save=0&param_services2filter_save=getFullTxt&param_services2filter_save=getSelectedFullTxt&param_pattern_save=&param_jumpToPage_save=&param_type_save=textSearch&param_langcode_save=en&param_vendor_save=&param_ui_control_scripts_save=&&param_perform_value=searchTitle"