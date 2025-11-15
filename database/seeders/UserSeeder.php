<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // البيانات من law_firm_backup.sql
        $users = [
            [
                'id' => 1,
                'name' => 'مدير النظام',
                'email' => 'admin@admin.sa',
                'password' => '$2y$12$hAaHUCgKF3iKQvuUgxMl5uM0EN2jEcr64dEeTPpiYJZJswdrGLjnK',
                'role' => 'مدير',
                'remember_token' => 'oH4waDuKZQXE8d9PsH7wGzSn89TcXZUHuF3kc7ibIYV6wDQk2eGh45D1UivV',
                'created_at' => '2025-11-15 00:15:29',
                'updated_at' => '2025-11-15 17:36:50',
            ],
            [
                'id' => 2,
                'name' => 'مسفر محمد العرجاني',
                'email' => 'lawyer1@lawfirm.sa',
                'password' => '$2y$12$9IdLjU0pGBFvG1Ngpsiep.sJLq/DIxKjwZXIF4GPrWotSMq/jJU2q',
                'role' => 'محامي',
                'remember_token' => null,
                'created_at' => '2025-11-15 00:15:29',
                'updated_at' => '2025-11-15 00:37:22',
            ],
            [
                'id' => 3,
                'name' => 'محمد عبدالله',
                'email' => 'lawyer2@lawfirm.sa',
                'password' => '$2y$12$YtyoF6LADOgJ9VdQZfCp4.ndsqdHMHCDRY2o3TggOrLueevbbpyWq',
                'role' => 'محامي',
                'remember_token' => null,
                'created_at' => '2025-11-15 00:15:29',
                'updated_at' => '2025-11-15 00:37:47',
            ],
            [
                'id' => 4,
                'name' => 'خالد سعيد',
                'email' => 'reception@lawfirm.sa',
                'password' => '$2y$12$FfKoy2b4XGTGJ4B6OoY9suYgdmZs4.ac98iO8/hsGK9Ipsn9SJOx.',
                'role' => 'موظف استقبال',
                'remember_token' => null,
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 00:31:18',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['id' => $user['id']],
                $user
            );
        }
    }
}

