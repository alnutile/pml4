<?php

class ProjectsTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('projects')->truncate();
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');
        for($i = 1; $i < 11; $i++ ) {
            $projects[] =
                array(
                    'name'          => "Test $i",
                    'giturl'        => 'https://github.com/alnutile/bbbbb_test',
                    'accountingurl' => "https://alfrednutile.freshbooks.com/test$i",
                    'active'        => 1,
                    'description'   => "Test $i",
                    'created_at'    => $dateTime,
                    'updated_at'    => $dateTime,
                );
        }
		DB::table('projects')->insert($projects);
        $user_id = DB::table('users')->where('username', 'LIKE', 'admin')->pluck('id');
        $project_id = DB::table('projects')->where('name', 'LIKE', 'Test 2')->pluck('id');
        $this->relateToUser1($project_id, $user_id, $dateTime);
        $project_id = DB::table('projects')->where('name', 'LIKE', 'Test 4')->pluck('id');
        $this->relateToUser1($project_id, $user_id, $dateTime);
        $project_id = DB::table('projects')->where('name', 'LIKE', 'Test 6')->pluck('id');
        $this->relateToUser1($project_id, $user_id, $dateTime);

        //User 2
        $user_id = DB::table('users')->where('username', 'LIKE', 'user')->pluck('id');
        $project_id = DB::table('projects')->where('name', 'LIKE', 'Test 6')->pluck('id');
        $this->relateToUser2($project_id, $user_id, $dateTime);
        $project_id = DB::table('projects')->where('name', 'LIKE', 'Test 1')->pluck('id');
        $this->relateToUser2($project_id, $user_id, $dateTime);
    }

    protected function relateToUser1($project_id, $user_id, $dateTime) {
        DB::table('project_user')->insert(
            array(
                'project_id' => $project_id,
                'user_id' => $user_id,
                'created_at' => $dateTime,
                'updated_at' => $dateTime
            ));
    }

    protected function relateToUser2($project_id, $user_id, $dateTime) {
        DB::table('project_user')->insert(
            array(
                'project_id' => $project_id,
                'user_id' => $user_id,
                'created_at' => $dateTime,
                'updated_at' => $dateTime
            ));
    }

}
