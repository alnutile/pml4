<?php

use Way\Tests\Factory;
use Project;

class ProjectTest extends TestCase {
    use Way\Tests\ModelHelpers;


    public function setUp()
    {
        parent::setUp();
    }

    public function testNameNotLongEnough()
    {
        $project = Factory::create('Project', array('name' => 't'));
        $this->assertNotValid($project);
    }

    public function testProjectBelongsToManyUsers()
    {
        $this->assertBelongsToMany('projects', 'User');
    }

    public function testNotLoggedInCanNotSeeDash()
    {
        Auth::logout();
        $crawler = $this->client->request('GET', '/dashboard');
        $this->assertRedirectedTo('/login');
    }

    public function testLoginSeeDash()
    {
        Auth::logout();
        $crawler = $this->client->request('GET', '/login');
        $form = $crawler->selectButton('Login')->form();
        $form['email'] = 'admin';
        $form['password'] = 'admin';
        $r = $this->client->submit($form);
        $crawler = $this->client->request('GET', '/dashboard');
        $h1 = $crawler->filter('h1');
        $this->assertEquals('Dashboard', $h1->text());
    }

    public function testNewProjectHasUserse()
    {
        $project    =   Factory::create('Project');
        $user       =   User::all()->first();
        $project->users()->attach(array($user->id), array('created_at' => $project->created_at, 'updated_at' => $project->created_at) );
        $people = $project->getAllPeople();
        $this->assertEquals($people[0]['id'], $user->id);
    }

    public function testGetEmails()
    {
        $p = Project::first();
        $u = $p->getUsersEmails();
        $this->assertEquals('1', count($u));
    }

    public function testAllIssues()
    {
        $p = Project::first();
        $i = $p->getAllIssues();
        $this->assertEquals('10', count($i));
        $p = DB::table('projects')->skip(1)->take(1)->get();
        $i = Project::find($p[0]->id)->issues;
        $this->assertLessThan('9', count($i));
    }

    public function testOptionsList()
    {
        $p = Project::first();
        $u = $p->getUsersSelectedOptionList();
        $this->assertEquals('1', $u[0]);
    }

}