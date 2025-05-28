<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FilamentAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists
        $adminEmail = 'admin@example.com';
        
        if (User::where('email', $adminEmail)->exists()) {
            $this->command->info("Admin user with email '{$adminEmail}' already exists. Skipping creation.");
            return;
        }

        // Create the admin user
        $admin = User::create([
            'name' => 'admin',
            'email' => $adminEmail,
            'password' => Hash::make('Password123'),
            'email_verified_at' => now(),
        ]);

        $this->command->info("Admin user created successfully with ID: {$admin->id}");
        $this->command->line("Email: {$admin->email}");
        $this->command->line("Password: Password123");
    }
}
