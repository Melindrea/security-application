<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

		$users = array(
            array(
                'display_name' => 'Marie',
                'password' => Hash::make('my_pass'),
                'email' => Crypt::encrypt('iam@mariehogebrandt.se'),
            ),
            array(
                'display_name' => 'Test',
                'password' => Hash::make('my_pass'),
                'email' => Crypt::encrypt('test@test.net'),
            ),
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
