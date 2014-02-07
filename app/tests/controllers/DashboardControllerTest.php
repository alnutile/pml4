<?php namespace DashboardController;

use Way\Tests\Factory;

class DashboardControllerTest extends \TestCase {
    use \Way\Tests\ControllerHelpers;

    public function setUp()
    {
        parent::setUp();
    }

    public function testDashDoesNotShowProjects() {
        \Auth::logout();
        $this->call('GET', '/dashboard');
        $this->notSee('Test 1');
        $this->notSee('Create Project');
    }

    public function testDashShowsProjects() {
        $this->call('GET', '/dashboard');
        $this->see('Test 1');
        $this->see('Create Project');
    }
}