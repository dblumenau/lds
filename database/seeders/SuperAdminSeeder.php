<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Make the test user we created a super admin
        $user = User::where('email', 'testuser@example.com')->first();
        
        if ($user) {
            $user->update([
                'is_superadmin' => true,
                'is_approved' => true,
                'approved_at' => now(),
            ]);
            
            $this->command->info('Made testuser@example.com a super admin!');
        } else {
            // Create a super admin if the test user doesn't exist
            User::create([
                'name' => 'Super Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'is_superadmin' => true,
                'is_approved' => true,
                'approved_at' => now(),
            ]);
            
            $this->command->info('Created admin@example.com as super admin (password: password)');
        }
    }
}
