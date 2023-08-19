<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'dashboard', 'create user', 'edit user', 'listing users', 'delete user'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        $admin = User::role('admin')->first();
        $admin->syncPermissions($permissions);
    }
}
