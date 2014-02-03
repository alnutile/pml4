<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
        DB::table('users')->delete();
        DB::table('projects')->delete();
        DB::table('project_user')->delete();
        DB::table('issues')->delete();
        DB::table('comments')->delete();
        $this->call('UsersTableSeeder');
		$this->call('ProjectsTableSeeder');
		$this->call('IssuesTableSeeder');
		$this->call('CommentsTableSeeder');
	}

}