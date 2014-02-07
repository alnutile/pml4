<?php

use Way\Tests\Factory;

class IssueTest extends TestCase {
    use Way\Tests\ModelHelpers;

    public function setUp()
    {
        parent::setUp();
    }

    public function testGetAllCommentsQuery() {
        $i = Issue::where('name', 'LIKE', 'Test 1')->get();
        $this->assertGreaterThan(0, count($i[0]->getAllComments()));
    }
}