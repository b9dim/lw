<?php

namespace Database\Seeders;

use App\Models\Case_;
use Illuminate\Database\Seeder;

class CaseSeeder extends Seeder
{
    public function run(): void
    {
        // البيانات من law_firm_backup.sql
        $cases = [
            [
                'id' => 1,
                'case_number' => 'CASE-2025-282240',
                'client_id' => 1,
                'lawyer_id' => 2,
                'court_name' => 'محكمة الرياض العامة',
                'status' => 'قيد المعالجة',
                'description' => 'قضية تعويضات ناتجة عن حادث مروري',
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 18:28:04',
            ],
            [
                'id' => 2,
                'case_number' => 'CASE-2025-288796',
                'client_id' => 2,
                'lawyer_id' => 3,
                'court_name' => 'محكمة جدة التجارية',
                'status' => 'قيد المحاكمة',
                'description' => 'قضية تجارية متعلقة بعقد بيع',
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 18:28:11',
            ],
            [
                'id' => 3,
                'case_number' => 'CASE-2025-298464',
                'client_id' => 1,
                'lawyer_id' => 2,
                'court_name' => 'محكمة الدمام',
                'status' => 'منتهية',
                'description' => 'قضية عقارية',
                'created_at' => '2025-11-15 00:15:30',
                'updated_at' => '2025-11-15 18:42:16',
            ],
            [
                'id' => 4,
                'case_number' => 'CASE-2025-274963',
                'client_id' => 1,
                'lawyer_id' => 2,
                'court_name' => 'العليا',
                'status' => 'ملغاة',
                'description' => 'ملغاة',
                'created_at' => '2025-11-15 18:17:51',
                'updated_at' => '2025-11-15 18:27:57',
            ],
        ];

        foreach ($cases as $case) {
            Case_::updateOrCreate(
                ['id' => $case['id']],
                $case
            );
        }
    }
}

