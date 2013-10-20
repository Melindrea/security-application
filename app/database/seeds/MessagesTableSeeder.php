<?php

class MessagesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		// DB::table('messages')->truncate();

		$messages = array(
            array(
                'user_id' => 1,
                'type_id' => 1,
                'content' => 'Here\'s a message!',
                'subject' => 'This is the subject',
            ),
		);

		// Uncomment the below to run the seeder
		DB::table('messages')->insert($messages);
	}

}
