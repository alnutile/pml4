<?php namespace ProjectsController;

use Way\Tests\Factory;
use Illuminate\Auth;

class ProjectsControllerTest extends \TestCase {
    use \Way\Tests\ControllerHelpers;

    public function __construct()
    {
        parent::setUp();
        $this->mock = \Mockery::mock('Eloquent', 'Project');
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    public function setUp()
    {
        parent::setUp();
    }

    public function testDashShowsProjects() {
        $this->call('GET', '/dashboard');
        $this->see('Test 1');
        $this->see('Create Project');
    }

    public function testShow() {
//        $this->mock
//            ->shouldReceive('show')
//            ->once()
//            ->andReturn(array(
//                'id'            => 100,
//                'name'          => 'Test 1',
//                'description'   => "Lorem",
//                'active'        => TRUE
//            ));
//        $this->app->instance('Project', $this->mock);
        $response = $this->call('GET', "dashboard");
        var_dump($response->original->getData()['projects']);
    }

}