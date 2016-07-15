<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
class FeatureContext extends MinkContext
{
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

    /**
     * @When I wait for :text to appear
     * @Then I should see :text appear
     * @param $text
     * @throws \Exception
     */
    public function iWaitForTextToAppear($text)
    {
        $this->spin(function (FeatureContext $context) use ($text) {
            try {
                $context->assertPageContainsText($text);
                return true;
            } catch (\Behat\Mink\Exception\ResponseTextException $e) {
                // NOOP
            }
            return false;
        });
    }


    /**
     * @When I wait for :text to disappear
     * @Then I should see :text disappear
     * @param $text
     * @throws \Exception
     */
    public function iWaitForTextToDisappear($text)
    {
        $this->spin(function (FeatureContext $context) use ($text) {
            try {
                $context->assertPageContainsText($text);
            } catch (\Behat\Mink\Exception\ResponseTextException $e) {
                return true;
            }
            return false;
        });
    }

    /**
     * Based on Behat's own example
     * @see http://docs.behat.org/en/v2.5/cookbook/using_spin_functions.html#adding-a-timeout
     * @param $lambda
     * @param int $wait
     * @throws \Exception
     */
    public function spin($lambda, $wait = 60)
    {
        $time = time();
        $stopTime = $time + $wait;
        while (time() < $stopTime) {
            try {
                if ($lambda($this)) {
                    return;
                }
            } catch (\Exception $e) {
                // do nothing
            }

            usleep(250000);
        }

        throw new \Exception("Spin function timed out after {$wait} seconds");
    }

    /**
     * @When /^I select the "([^"]*)" radio button$/
     */
    public function iSelectTheRadioButton($labelText)
    {
        // Find the label by its text, then use that to get the radio item's ID
        $radioId = null;
        $ctx = $this;

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
     * Click some text
     *
     * @When /^I click on the text "([^"]*)"$/
     */
    public function iClickOnTheText($text)
    {
        $session = $this->getSession();
        $element = $session->getPage()->find(
            'xpath',
            $session->getSelectorsHandler()->selectorToXpath('xpath', '*//*[text()="' . $text . '"]')
        );
        if (null === $element) {
            throw new \InvalidArgumentException(sprintf('Cannot find text: "%s"', $text));
        }

        $element->click();

    }

    /**
     * Click on a link
     *
     * @When /^I click on the link "([^"]*)"$/
     */
    public function iClickOnTheLink($link)
    {
        $row = $this->getSession()->getPage()->find('css', sprintf('a:contains("%s")', $link));
        if (!$row) {
            throw new \Behat\Mink\Exception\ElementNotFoundException($this->getSession(), 'element', 'css', $link);
        }

        $row->click();
    }

    /**
     * Click on the back link
     *
     * @When I click the back button
     */
    public function iClickTheBackButton(){
        $this->getSession()->getDriver()->back();
    }
    
    /**
     * Click on the forward button
     * 
     * @When I click the forward button
     */
    public function iClickTheForwardButton(){
        $this->getSession()->getDriver()->forward();
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
     * @Given /^I switch to the next tab/
     *
     */
    public function iSwitchTo(){
        $windowNames = $this->getSession()->getWindowNames();
        if(count($windowNames) > 1) {
            $this->getSession()->switchToWindow($windowNames[1]);
        }
    }

}