<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\Mink;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Step;
use Behat\Mink\Exception\UnsupportedDriverActionException;
use Behat\Mink\Driver\GoutteDriver;
use Illuminate\Foundation\Testing\TestCase;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     * Load other context files
     *
     * @param array $parameters context parameters (set up via behat.yml)
     */
    public function __construct(array $parameters) {

        // import all context classes from context directory, except the abstract one
        $filesToSkip = ['FeatureContext.php', 'BaseContext.php'];

        $path = dirname(__FILE__);
        $it = new RecursiveDirectoryIterator($path);

        foreach ($it as $file)
        {
            if (! $file->isDir()) {
               $name = $file->getFilename();

                if (in_array($name, $filesToSkip))
                    continue;

                $class = pathinfo($name, PATHINFO_FILENAME);
                require_once $path.'/'.$name;
                $this->useContext($class, new $class($parameters));
            }
        }
        exec('/usr/bin/php artisan migrate --database sqlite --env testing --seed', $output, $return_var);
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
