<?php

class IssuesTableSeeder extends Seeder {

	public function run()
	{

        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');

        //User 1
        $user_id = DB::table('users')->where('username', 'LIKE', 'admin')->pluck('id');

        $project_id = DB::table('projects')->where('name', 'LIKE', 'Test 1')->pluck('id');
        $this->makeIssues($project_id, $user_id, $dateTime);

        $project_id = DB::table('projects')->where('name', 'LIKE', 'Test 3')->pluck('id');
        $this->makeIssues($project_id, $user_id, $dateTime);

        $project_id = DB::table('projects')->where('name', 'LIKE', 'Test 6')->pluck('id');
        $this->makeIssues($project_id, $user_id, $dateTime);

        //User 2
        $user_id = DB::table('users')->where('username', 'LIKE', 'user')->pluck('id');

        $project_id = DB::table('projects')->where('name', 'LIKE', 'Test 4')->pluck('id');
        $this->makeIssues($project_id, $user_id, $dateTime);

        $project_id = DB::table('projects')->where('name', 'LIKE', 'Test 2')->pluck('id');
        $this->makeIssues($project_id, $user_id, $dateTime);

	}

    public function makeIssues($project_id, $user_id, $dateTime) {
        for($i = 1; $i < 11; $i++ ) {
            $issues[] =
                array(
                    'name'          => "Test $i",
                    'github_id'        => $i,
                    'project_id' => $project_id,
                    'user_id' => $user_id,
                    'active'        => 1,
                    'description'   => "Issue $i",
                    'created_at'    => $dateTime,
                    'updated_at'    => $dateTime,
                );
        }
        DB::table('issues')->insert($issues);
    }


}
