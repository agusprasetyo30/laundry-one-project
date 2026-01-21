<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'password' => bcrypt('superadmin'),
            'is_admin' => true,
        ]);

        // User
        User::create([
            'name' => 'User',
            'username' => 'user1',
            'password' => bcrypt('user1'),
        ]);

        $this->command->info('UserSeeder: Seeded user data successfully.');
    }
}
