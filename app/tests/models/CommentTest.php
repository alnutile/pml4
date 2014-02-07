<?php

use Way\Tests\Factory;

class CommentTest extends TestCase {
    use Way\Tests\ModelHelpers;

    public function setUp()
    {
        parent::setUp();
    }

    public function testIssueHasComments() {
        $c = Comment::first();
             $this->assertNotEmpty($c->issue());
    }

}