<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        if (!Client::where('national_id', '1234567890')->exists()) {
            Client::create([
                'name' => 'محمد عبدالله العلي',
                'national_id' => '1234567890',
                'phone' => '0501234567',
                'email' => 'client1@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        if (!Client::where('national_id', '0987654321')->exists()) {
            Client::create([
                'name' => 'سارة أحمد الخالدي',
                'national_id' => '0987654321',
                'phone' => '0509876543',
                'email' => 'client2@example.com',
                'password' => Hash::make('password'),
            ]);
        }

        if (!Client::where('national_id', '1122334455')->exists()) {
            Client::create([
                'name' => 'عبدالرحمن خالد السعيد',
                'national_id' => '1122334455',
                'phone' => '0501122334',
                'email' => 'client3@example.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}

