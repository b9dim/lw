<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'admin@lawfirm.sa')->exists()) {
            User::create([
                'name' => 'مدير النظام',
                'email' => 'admin@lawfirm.sa',
                'password' => Hash::make('password'),
                'role' => 'مدير',
            ]);
        }

        if (!User::where('email', 'lawyer1@lawfirm.sa')->exists()) {
            User::create([
                'name' => 'أحمد محمد المحامي',
                'email' => 'lawyer1@lawfirm.sa',
                'password' => Hash::make('password'),
                'role' => 'محامي',
            ]);
        }

        if (!User::where('email', 'lawyer2@lawfirm.sa')->exists()) {
            User::create([
                'name' => 'فاطمة علي المحامية',
                'email' => 'lawyer2@lawfirm.sa',
                'password' => Hash::make('password'),
                'role' => 'محامي',
            ]);
        }

        if (!User::where('email', 'reception@lawfirm.sa')->exists()) {
            User::create([
                'name' => 'خالد سعيد',
                'email' => 'reception@lawfirm.sa',
                'password' => Hash::make('password'),
                'role' => 'موظف استقبال',
            ]);
        }
    }
}

