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
        $superAdmins = [
            [
                'name' => 'David Blumenau',
                'email' => 'dblumenau@gmail.com',
            ],
            [
                'name' => 'Rob van der West',
                'email' => 'robvdwest.dk@gmail.com',
            ],
        ];

        foreach ($superAdmins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => bcrypt('password'),
                    'is_superadmin' => true,
                    'is_approved' => true,
                    'approved_at' => now(),
                    'email_verified_at' => now(),
                ]
            );
            
            $this->command->info("Created/updated super admin: {$admin['email']}");
        }
        
        $this->command->info('Super admin users ready (default password: password)');
    }
}
