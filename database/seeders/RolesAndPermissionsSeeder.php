<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'super admin',
                'guard_name' => 'web',
                'created_at' => '2022-04-08 10:00:00',
                'updated_at' => '2022-04-08 10:00:00',
            ),
           
           
            1 => 
            array (
                'id' => 2,
                'name' => 'normal user',
                'guard_name' => 'web',
                'created_at' => '2022-04-08 10:00:00',
                'updated_at' => '2022-04-08 10:00:00',
            ),
    
        ));

        \DB::table('permissions')->delete();

        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'view all projects',
                'guard_name' => 'web',
                'created_at' => '2022-04-08 10:00:00',
                'updated_at' => '2022-04-08 10:00:00',
            ),
           
           
            1 => 
            array (
                'id' => 2,
                'name' => 'manage users',
                'guard_name' => 'web',
                'created_at' => '2022-04-08 10:00:00',
                'updated_at' => '2022-04-08 10:00:00',
            ),

            2 => 
            array (
                'id' => 3,
                'name' => 'view settings',
                'guard_name' => 'web',
                'created_at' => '2022-04-08 10:00:00',
                'updated_at' => '2022-04-08 10:00:00',
            ),
            
        ));

        \DB::table('role_has_permissions')->delete();

        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'permission_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'permission_id' => 2,
                'role_id' => 1,
            ),
            2 => 
            array (
                'permission_id' => 3,
                'role_id' => 1,
            ),
        ));
    }
}
