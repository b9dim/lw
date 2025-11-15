<?php

namespace Database\Seeders;

use App\Models\Case_;
use App\Models\CaseUpdate;
use App\Models\Inquiry;
use Illuminate\Database\Seeder;

class CaseSeeder extends Seeder
{
    public function run(): void
    {
        $client1 = \App\Models\Client::where('national_id', '1234567890')->first();
        $client2 = \App\Models\Client::where('national_id', '0987654321')->first();
        $lawyer1 = \App\Models\User::where('email', 'lawyer1@lawfirm.sa')->first();
        $lawyer2 = \App\Models\User::where('email', 'lawyer2@lawfirm.sa')->first();

        // Case 1
        if (!Case_::where('case_number', 'CASE-2024-001')->exists()) {
            $case1 = Case_::create([
                'case_number' => 'CASE-2024-001',
                'client_id' => $client1->id,
                'lawyer_id' => $lawyer1->id,
                'court_name' => 'محكمة الرياض العامة',
                'status' => 'قيد المعالجة',
                'description' => 'قضية تعويضات ناتجة عن حادث مروري',
            ]);

            CaseUpdate::create([
                'case_id' => $case1->id,
                'title' => 'بدء الإجراءات القانونية',
                'detail' => 'تم تقديم الملف إلى المحكمة وبدء الإجراءات القانونية',
            ]);

            CaseUpdate::create([
                'case_id' => $case1->id,
                'title' => 'جلسة استماع',
                'detail' => 'تم تحديد موعد جلسة الاستماع في 15/03/2024',
            ]);

            Inquiry::create([
                'case_id' => $case1->id,
                'client_id' => $client1->id,
                'message' => 'متى موعد الجلسة القادمة؟',
                'reply' => 'الجلسة القادمة في 15/03/2024 الساعة 10 صباحاً',
                'replied_at' => now(),
            ]);
        }

        // Case 2
        if (!Case_::where('case_number', 'CASE-2024-002')->exists()) {
            $case2 = Case_::create([
                'case_number' => 'CASE-2024-002',
                'client_id' => $client2->id,
                'lawyer_id' => $lawyer2->id,
                'court_name' => 'محكمة جدة التجارية',
                'status' => 'قيد المحاكمة',
                'description' => 'قضية تجارية متعلقة بعقد بيع',
            ]);

            CaseUpdate::create([
                'case_id' => $case2->id,
                'title' => 'بدء المحاكمة',
                'detail' => 'تم بدء جلسات المحاكمة في القضية',
            ]);

            Inquiry::create([
                'case_id' => $case2->id,
                'client_id' => $client2->id,
                'message' => 'ما هي آخر التطورات في القضية؟',
            ]);
        }

        // Case 3
        if (!Case_::where('case_number', 'CASE-2024-003')->exists()) {
            $case3 = Case_::create([
                'case_number' => 'CASE-2024-003',
                'client_id' => $client1->id,
                'lawyer_id' => $lawyer1->id,
                'court_name' => 'محكمة الدمام',
                'status' => 'منتهية',
                'description' => 'قضية عقارية',
            ]);

            CaseUpdate::create([
                'case_id' => $case3->id,
                'title' => 'انتهاء القضية',
                'detail' => 'تم الحكم في القضية لصالح العميل',
            ]);
        }
    }
}

