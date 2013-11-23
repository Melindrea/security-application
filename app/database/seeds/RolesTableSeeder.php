<?php

class RolesTableSeeder extends Seeder {

    public function run()
    {
        // Uncomment the below to wipe the table clean before populating
        DB::table('roles')->truncate();

        $roles = array(
            array(
                'name' => 'login',
                'description' => 'Base role which allows logging in',
            ),
            array(
                'name' => 'storyteller',
                'description' => 'Storyteller capabilities',
            ),
            array(
                'name' => 'admin',
                'description' => 'Admin capabilities',
            ),
        );

        // Uncomment the below to run the seeder
        DB::table('roles')->insert($roles);
    }

}
