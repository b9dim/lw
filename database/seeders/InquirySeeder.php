<?php

namespace Database\Seeders;

use App\Models\Inquiry;
use Illuminate\Database\Seeder;

class InquirySeeder extends Seeder
{
    public function run(): void
    {
        // البيانات من law_firm_backup.sql
        $inquiries = [
            [
                'id' => 1,
                'case_id' => 1,
                'client_id' => 1,
                'message' => 'متى موعد الجلسة القادمة؟',
                'reply' => 'الجلسة القادمة في 15/03/2024 الساعة 10 صباحاً',
                'replied_at' => '2025-11-15 00:15:30',
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 00:15:30',
            ],
            [
                'id' => 2,
                'case_id' => 2,
                'client_id' => 2,
                'message' => 'ما هي آخر التطورات في القضية؟',
                'reply' => null,
                'replied_at' => null,
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 00:15:30',
            ],
            [
                'id' => 3,
                'case_id' => 3,
                'client_id' => 1,
                'message' => 'هذا استفسار تجريبي',
                'reply' => 'وهذا رد تجريبي',
                'replied_at' => '2025-11-15 01:52:38',
                'created_at' => '2025-11-15 00:27:14',
                'updated_at' => '2025-11-15 01:52:38',
            ],
            [
                'id' => 4,
                'case_id' => 1,
                'client_id' => 1,
                'message' => 'هل يمكنني تأجيل الجلسة؟',
                'reply' => 'نعم',
                'replied_at' => '2025-11-15 00:31:52',
                'created_at' => '2025-11-15 00:27:58',
                'updated_at' => '2025-11-15 00:31:52',
            ],
            [
                'id' => 5,
                'case_id' => 1,
                'client_id' => 1,
                'message' => 'هل تجديد التأمين بعد يوم يفيد؟',
                'reply' => 'لا',
                'replied_at' => '2025-11-15 02:26:44',
                'created_at' => '2025-11-15 00:44:21',
                'updated_at' => '2025-11-15 02:26:44',
            ],
            [
                'id' => 6,
                'case_id' => 3,
                'client_id' => 1,
                'message' => 'تجربة التحديث الاخير',
                'reply' => 'التحديث يعمل',
                'replied_at' => '2025-11-15 02:39:40',
                'created_at' => '2025-11-15 02:35:26',
                'updated_at' => '2025-11-15 02:39:40',
            ],
        ];

        foreach ($inquiries as $inquiry) {
            Inquiry::updateOrCreate(
                ['id' => $inquiry['id']],
                $inquiry
            );
        }
    }
}

