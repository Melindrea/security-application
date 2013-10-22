<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('users')->truncate();

		$users = array(
            array(
                'display_name' => 'Marie',
                'username' => 'marie',
                'password' => Hash::make('my_pass'),
                'email' => Crypt::encrypt('iam@mariehogebrandt.se'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
            array(
                'display_name' => 'Test',
                'username' => 'test',
                'password' => Hash::make('my_pass'),
                'email' => Crypt::encrypt('test@test.net'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ),
		);

		// Uncomment the below to run the seeder
		DB::table('users')->insert($users);
	}

}
