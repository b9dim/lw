<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        // البيانات من law_firm_backup.sql
        $clients = [
            [
                'id' => 1,
                'name' => 'عبدالله محمد الاسمري',
                'national_id' => '1234567890',
                'phone' => '0501234567',
                'email' => 'b9di@hotmail.com',
                'password' => '$2y$12$kHQC5snLi/D3mCmgQJErJe4N3rXP.Aw/UFPsJGEBKPveWul2Zp8d.',
                'remember_token' => null,
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 17:21:55',
            ],
            [
                'id' => 2,
                'name' => 'سارة أحمد الخالدي',
                'national_id' => '0987654321',
                'phone' => '0509876543',
                'email' => 'client2@example.com',
                'password' => '$2y$12$HzHdxo.D/IDFGVda6fOXq.03tqVunIDAhYQTnBHSk3TEjrc37M0Ym',
                'remember_token' => null,
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 00:15:30',
            ],
            [
                'id' => 3,
                'name' => 'عبدالرحمن خالد السعيد',
                'national_id' => '1122334455',
                'phone' => '0501122334',
                'email' => 'client3@example.com',
                'password' => '$2y$12$FRJNSvmoAB7Dj1h8yp3uiOaO8buSpThDU3bF.k0p7CX5268MdZLpi',
                'remember_token' => null,
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 00:15:30',
            ],
            [
                'id' => 4,
                'name' => 'احمد',
                'national_id' => '1082459106',
                'phone' => null,
                'email' => 'a@b9d.im',
                'password' => '$2y$12$cB8IK0HVSgKOQV20GdeEaennf7E3cdmJ.W9kvgko77rkCAmE.j8X2',
                'remember_token' => null,
                'created_at' => '2025-11-15 03:02:02',
                'updated_at' => '2025-11-15 17:24:01',
            ],
        ];

        foreach ($clients as $client) {
            Client::updateOrCreate(
                ['id' => $client['id']],
                $client
            );
        }
    }
}

