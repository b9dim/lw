<?php

namespace Database\Seeders;

use App\Models\CaseUpdate;
use Illuminate\Database\Seeder;

class CaseUpdateSeeder extends Seeder
{
    public function run(): void
    {
        // البيانات من law_firm_backup.sql
        $updates = [
            [
                'id' => 1,
                'case_id' => 1,
                'title' => 'بدء الإجراءات القانونية',
                'detail' => 'تم تقديم الملف إلى المحكمة وبدء الإجراءات القانونية',
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 00:15:30',
            ],
            [
                'id' => 2,
                'case_id' => 1,
                'title' => 'جلسة استماع',
                'detail' => 'تم تحديد موعد جلسة الاستماع في 15/03/2024',
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 00:15:30',
            ],
            [
                'id' => 3,
                'case_id' => 2,
                'title' => 'بدء المحاكمة',
                'detail' => 'تم بدء جلسات المحاكمة في القضية',
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 00:15:30',
            ],
            [
                'id' => 4,
                'case_id' => 3,
                'title' => 'انتهاء القضية',
                'detail' => 'تم الحكم في القضية لصالح العميل',
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 00:15:30',
            ],
            [
                'id' => 5,
                'case_id' => 1,
                'title' => 'تم التواصل عبر الهاتف',
                'detail' => 'تم التواصل عبر الهاتف',
                'created_at' => '2025-11-15 00:38:42',
                'updated_at' => '2025-11-15 00:38:42',
            ],
            [
                'id' => 6,
                'case_id' => 4,
                'title' => 'تم الالغاء',
                'detail' => 'نعتذر منك تم الغاء القضية بسبب ان القضة ليست من اختصاصنا',
                'created_at' => '2025-11-15 18:18:41',
                'updated_at' => '2025-11-15 18:18:41',
            ],
        ];

        foreach ($updates as $update) {
            CaseUpdate::updateOrCreate(
                ['id' => $update['id']],
                $update
            );
        }
    }
}

