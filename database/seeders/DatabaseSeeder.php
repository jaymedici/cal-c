<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'user',
                'guard_name' => 'web',
                'created_at' => '2020-12-10 08:53:34',
                'updated_at' => '2020-12-10 08:53:34',
            ),
           
           
            1 => 
            array (
                'id' => 2,
                'name' => 'super admin',
                'guard_name' => 'web',
                'created_at' => '2020-12-10 12:00:18',
                'updated_at' => '2020-12-10 12:00:18',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'admin',
                'guard_name' => 'web',
                'created_at' => '2020-12-10 12:00:18',
                'updated_at' => '2020-12-10 12:00:18',
            ),
        ));


        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'manage calendar',
                'guard_name' => 'web',
                'created_at' => '2020-12-10 09:04:13',
                'updated_at' => '2020-12-10 09:04:13',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'manage visit sesitngs',
                'guard_name' => 'web',
                'created_at' => '2020-12-10 09:50:52',
                'updated_at' => '2020-12-10 09:50:52',
            ),
            3 => 
            array (
                'id' => 3,
                'name' => 'manages users',
                'guard_name' => 'web',
                'created_at' => '2020-12-10 09:50:52',
                'updated_at' => '2020-12-10 09:50:52',
            ),

            4 => 
            array (
                'id' => 4,
                'name' => 'view calendar',
                'guard_name' => 'web',
                'created_at' => '2020-12-10 09:04:13',
                'updated_at' => '2020-12-10 09:04:13',
            ),
            
            
        ));


        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 2,
            ),
            1 => 
            array (
                'permission_id' => 1,
                'role_id' => 3,
            ),
            2 => 
            array (
                'permission_id' => 2,
                'role_id' => 2,
            ),
            3 => 
            array (
                'permission_id' => 2,
                'role_id' => 3,
            ),
            4 => 
            array (
                'permission_id' => 3,
                'role_id' => 2,
            ),
            5 => 
            array (
                'permission_id' => 4,
                'role_id' => 1,
            ),
            5 => 
            array (
                'permission_id' => 4,
                'role_id' => 2,
            ),
            5 => 
            array (
                'permission_id' => 4,
                'role_id' => 3,
            ),


        ));

    }
}
