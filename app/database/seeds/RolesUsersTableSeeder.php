<?php

class RolesUsersTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('role_user')->truncate();

        $rolesUsers = array(
            array(
                'role_id' => 1,
                'user_id' => 1,
            ),
            array(
                'role_id' => 2,
                'user_id' => 1,
            ),
        );

        // Uncomment the below to run the seeder
        DB::table('role_user')->insert($rolesUsers);
    }

}
