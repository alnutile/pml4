<?php

class CommentsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('comments')->truncate();
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');

        $user_id = DB::table('users')->where('username', 'LIKE', 'admin')->pluck('id');

        $issue_id = DB::table('issues')->where('name', 'LIKE', 'Test 1')->pluck('id');
        $this->makeComment($user_id, $issue_id, $dateTime);

        $issue_id = DB::table('issues')->where('name', 'LIKE', 'Test 3')->pluck('id');
        $this->makeComment($user_id, $issue_id, $dateTime);

        $issue_id = DB::table('issues')->where('name', 'LIKE', 'Test 6')->pluck('id');
        $this->makeComment($user_id, $issue_id, $dateTime);

        //User 2
        $user_id = DB::table('users')->where('username', 'LIKE', 'user')->pluck('id');

        $issue_id = DB::table('issues')->where('name', 'LIKE', 'Test 4')->pluck('id');

        $this->makeComment($user_id, $issue_id, $dateTime);
        $issue_id = DB::table('issues')->where('name', 'LIKE', 'Test 2')->pluck('id');
        $this->makeComment($user_id, $issue_id, $dateTime);
	}

    public function makeComment($user_id, $issue_id, $dateTime) {
        for($i = 1; $i < 11; $i++ ) {
            $comments[] =
                array(
                    'body'          => "Test $i",
                    'issue_id'        => $issue_id,
                    'user_id' => $user_id,
                    'github_id' => $i,
                    'created_at'    => $dateTime,
                    'updated_at'    => $dateTime,
                );
        }
        DB::table('comments')->insert($comments);
    }

}
