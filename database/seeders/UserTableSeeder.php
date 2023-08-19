<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'role' => 'user'
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'role' => 'admin'
            ]
        ];

        foreach ($users as $user) {
            $saveUser = new User;
            $saveUser->name = $user['name'];
            $saveUser->email = $user['email'];
            $saveUser->password = bcrypt('12345678');
            $saveUser->save();

            $saveUser->assignRole($user['role']);
        }
    }
}
