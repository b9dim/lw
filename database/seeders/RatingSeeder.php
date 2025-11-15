<?php

namespace Database\Seeders;

use App\Models\Rating;
use Illuminate\Database\Seeder;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        // البيانات من law_firm_backup.sql
        $ratings = [
            [
                'id' => 4,
                'client_id' => 1,
                'rating' => 5,
                'comment' => 'تعامل راقي وسرعة في الانجاز',
                'status' => 'pending',
                'created_at' => '2025-11-15 18:47:15',
                'updated_at' => '2025-11-15 18:47:15',
            ],
        ];

        foreach ($ratings as $rating) {
            Rating::updateOrCreate(
                ['id' => $rating['id']],
                $rating
            );
        }
    }
}

