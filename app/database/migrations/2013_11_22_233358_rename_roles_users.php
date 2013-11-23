<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class RenameRolesUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::rename('roles_users', 'role_user');
		Schema::rename('capabilities_roles', 'capability_role');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::rename('role_user', 'roles_users');
        Schema::rename('capability_role', 'capabilities_roles');
	}

}
