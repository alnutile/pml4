<?php

use Zizaco\FactoryMuff\Facade\FactoryMuff;
use Way\Tests\Factory;

class ProjectTest extends TestCase {
    use Way\Tests\ModelHelpers;

    public function testNameNotLongEnough()
    {
        $project = Factory::create('Project', array('name' => 't'));
        $this->assertNotValid($project);
    }

    public function testProjectBelongsToManyUsers()
    {
        $this->assertBelongsToMany('projects', 'User');
    }

    public function testProjectHasManyIssues()
    {
        //$this->assertHasMany('project', 'Issue');
    }

    public function testLogin()
    {
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['email'] = 'admin';
        $form['password'] = 'admin';
        $r = $this->client->submit($form);
        $crawler = $this->client->request('GET', '/dashboard');
        $h1 = $crawler->filter('h1');
        $this->assertEquals('Dashboard', $h1->text());
    }


}