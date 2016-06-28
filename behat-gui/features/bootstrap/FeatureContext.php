<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext
{

    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct()
    {
        // Initialize your context here
    }
     /**
  * @Given /^wait (\d+) second$/
  */
 public function waitSecond($arg1)
 {
    $this->getSession()->wait(1000*$arg1);
     //throw new PendingException();
 }
  
  
  /**
  * @Then /^I press the "([^"]*)" button in the browser$/
  */
 public function iPressTheButtonInTheBrowser($arg1)
 {
    $session = $this->getSession();
    if ($arg1 == 'back') {
            $session->back();
        } else if ($arg1 == 'forward') {
            $session->forward();
        } else if ($arg1 == 'reload') {
            $session->reload();
        } else {
            throw new ExpectationException('Unknown browser button.', $session);
        }
     
     
 }
     /**
  * @Given /^I click the "([^"]*)" button$/
  */
 public function iClickTheButton($arg1)
 {
    $findName = $this->getSession()->getPage()->find("css", $arg1);
        if (!$findName) {
            throw new Exception($arg1 . " could not be found");
        } else {
            $findName->click();
        }
 }
     
    /**
 * @When /^I select the "([^"]*)" radio button$/
 */
public function iSelectTheRadioButton($labelText)
{
    // Find the label by its text, then use that to get the radio item's ID
    $radioId = null;
    $ctx = $this->getMainContext();
    /** @var $label NodeElement */
    foreach ($ctx->getSession()->getPage()->findAll('css', 'label') as $label) {
        if ($labelText === $label->getText()) {
            if ($label->hasAttribute('for')) {
                $radioId = $label->getAttribute('for');
                break;
            } else {
                throw new \Exception("Radio button's label needs the 'for' attribute to be set");
            }
        }
    }
    if (!$radioId) {
        throw new \InvalidArgumentException("Label '$labelText' not found.");
    }
    // Now use the ID to retrieve the button and click it
    /** @var NodeElement $radioButton */
    $radioButton = $ctx->getSession()->getPage()->find('css', "#$radioId");
    if (!$radioButton) {
        throw new \Exception("$labelText radio button not found.");
    }
    $ctx->fillField($radioId, $radioButton->getAttribute('value'));
}
    /**
 * @When /^I hover over the element "([^"]*)"$/
 */
public function iHoverOverTheElement($locator)
{
        $session = $this->getSession(); // get the mink session
        $element = $session->getPage()->find('css', $locator); // runs the actual query and returns the element
        // errors must not pass silently
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Could not evaluate CSS selector: "%s"', $locator));
        }
        // ok, let's hover it
        $element->mouseOver();
}
/**
 * @Given /^I wait for the suggestion box to appear$/
 */
public function iWaitForTheSuggestionBoxToAppear()
{
    $this->getSession()->wait(5000,
        "$('.suggestions-results').children().length > 0"
    );
}

/**
 * @Given I click the :arg1 element
 */
public function iClickTheElement($selector)
{
    $page = $this->getSession()->getPage();
    $element = $page->find('css', $selector);

    if (empty($element)) {
        throw new Exception("No html element found for the selector ('$selector')");
    }

    $element->click();
}

}

