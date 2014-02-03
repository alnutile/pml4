<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
        $dateTime = new DateTime('now');
        $dateTime = $dateTime->format('Y-m-d H:i:s');
        $users = array(
            array(
                'username'      => 'admin',
                'email'      => 'alfrednutile@gmail.com',
                'password'   => Hash::make('admin'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'admin'     => TRUE,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ),
            array(
                'username'      => 'user',
                'email'      => 'me@alfrednutile.info',
                'password'   => Hash::make('user'),
                'confirmed'   => 1,
                'confirmation_code' => md5(microtime().Config::get('app.key')),
                'admin'     => FALSE,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            )
        );
        DB::table('users')->insert( $users );
	}

}
