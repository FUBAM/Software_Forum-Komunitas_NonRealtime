<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = 'admin@mail.com';

        $user = User::firstWhere('email', $email);
        if ($user) {
            // Ensure role set to admin
            if ($user->role !== 'admin') {
                $user->role = 'admin';
                $user->save();
            }
            $this->command->info("Admin user exists: {$email}");
            return;
        }

        // Create admin (idempotent because we check existence above)
        User::create([
            'nama' => 'Admin Pusat',
            'email' => $email,
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'xp_terkini' => 0,
            'level_terkini' => 1,
            'skor_kepercayaan' => 100,
            'terpercaya' => true,
        ]);

        $this->command->info("Created admin user: {$email} (password: admin123)");
    }
}