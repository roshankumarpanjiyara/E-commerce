<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Role;
use App\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Role::create([
            'id'=>'1',
            'name' => 'Super Admin'
        ]);
        Role::create([
            'id'=>'2',
            'name' => 'Admin'
        ]);
        Permission::create([
            'role_id' => 1,
            'name' => ['role'=>['can-view'=>'1'],
                       'permission'=>['can-view'=>'1'],
                       'user'=>['can-view'=>'1'],
                        ]
        ]);
        Admin::create([
            'id'=>'1',
            'name' => 'Super Admin',
            'email' => 'super.admin@gmail.com',
            'email_verified_at'=> NOW(),
            'password'=>bcrypt('password'),
            'role_id' => 1,
        ]);
    }
}
