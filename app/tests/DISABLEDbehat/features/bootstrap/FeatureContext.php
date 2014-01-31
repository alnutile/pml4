<?php

use Behat\Mink;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Step;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\Mink\Driver\GoutteDriver;

/**
 * Feature context.
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * Set a waiting time in seconds
     *
     * @Given /^I wait for "([^"]*)" seconds$/
     */
    public function iWaitForSeconds($arg1) {
        sleep($arg1);
    }

    /**
     * This will cause a 3 second delay
     *
     * @Given /^I wait$/
     */
    public function iWait() {
        sleep(3);
    }

    /**
     * Destroy cookies
     *
     * @Then /^I destroy my cookies$/
     */
    public function iDestroyMyCookies() {
        $this->getSession()->restart();
        $this->getSession()->reset();
    }

}
