<?php

use Illuminate\Database\Seeder;
use App\PermissionRole;
use Caffeinated\Shinobi\Models\Permission;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = Permission::all();

        foreach($permissions as $permission){
            PermissionRole::create([
                'permission_id' => $permission->id,
                'role_id'       => 1
            ]);
        }

        PermissionRole::create([
            'permission_id' => 31,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 32,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 33,
            'role_id'       => 2
        ]);

        for($i = 36; $i<=50; $i++){
            PermissionRole::create([
                'permission_id' => $i,
                'role_id'       => 2
            ]);
        }
        
        PermissionRole::create([
            'permission_id' => 52,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 53,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 56,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 57,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 58,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 61,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 62,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 63,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 64,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 65,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 67,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 68,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 72,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 73,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 77,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 78,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 81,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 82,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 83,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 84,
            'role_id'       => 2
        ]);
        PermissionRole::create([
            'permission_id' => 85,
            'role_id'       => 2
        ]);
    }
}
