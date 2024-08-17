<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_admin = Role::updateOrCreate(
            [
                'name' => 'Admin',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Admin',
                'guard_name' => 'web'
            ]

        );
        $role_user = Role::updateOrCreate(
            [
                'name' => 'Pegawai',
                'guard_name' => 'web'
            ],
            [
                'name' => 'Pegawai',
                'guard_name' => 'web'
            ]
        );

        $permission = Permission::updateOrCreate(
            [
                'name' => 'pages.admin.dashboard',
            ],
            [
                'name' => 'pages.admin.dashboard'
            ]
        );
        $role_admin->givePermissionTo($permission);
    }
}
