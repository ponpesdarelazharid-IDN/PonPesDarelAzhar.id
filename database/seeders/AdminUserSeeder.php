<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ponpesdarelazhar.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Admin@1234!'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Admin user created: admin@ponpesdarelazhar.id / Admin@1234!');
    }
}
