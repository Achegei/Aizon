<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if super admin already exists
        $existing = User::where('email', 'superadmin@aizon.com')->first();
        if ($existing) {
            $this->command->info('Super Admin already exists!');
            return;
        }

        // Create Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@aizon.com',
            'password' => Hash::make('password123'), // Change to a secure password
            'role' => UserRole::ADMIN, // We'll differentiate super admin in dashboard
            'is_active' => true,
            'settings' => [
                'is_super_admin' => true
            ]
        ]);

        $this->command->info('Super Admin created: superadmin@aizon.com / password123');
    }
}
