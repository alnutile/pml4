<?php

use Way\Tests\Factory;

class UserTest extends TestCase {
    use Way\Tests\ModelHelpers;

    public function setUp()
    {
        parent::setUp();
    }

    public function testIsAdmin()
    {
        $u = User::first();
        $this->assertFalse($u->is_admin());
        $u->admin = 1;
        $u->save();
        $this->assertTrue($u->is_admin());
    }

    public function testAllPeopleSelect()
    {
        $u = User::first();
        $ua = User::all();
        $this->assertEquals('2', count($u->allPeopleSelectOptions($ua)));
        $u->delete();
        $ua = User::all();
        $this->assertEquals('1', count($u->allPeopleSelectOptions($ua)));
    }

    public function testGetAllProjects() {
        $u = User::first();
        $this->assertGreaterThan(0, $u->getAllProjects());
    }

}