<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('messages', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('type_id');
            $table->string('content', 500);
            $table->string('subject', 140);
            $table->timestamps();
        });

        Schema::create('message_types', function(Blueprint $table) {
			$table->increments('id');
            $table->string('name', 140);
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('messages');
		Schema::drop('message_types');
	}

}
