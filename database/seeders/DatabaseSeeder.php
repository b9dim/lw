<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ترتيب مهم: يجب تشغيل Seeders بالترتيب الصحيح بسبب Foreign Keys
        $this->call([
            UserSeeder::class,        // أولاً: المستخدمون
            ClientSeeder::class,      // ثانياً: العملاء
            CaseSeeder::class,        // ثالثاً: القضايا (تعتمد على العملاء والمستخدمين)
            CaseUpdateSeeder::class,  // رابعاً: تحديثات القضايا (تعتمد على القضايا)
            InquirySeeder::class,     // خامساً: الاستفسارات (تعتمد على القضايا والعملاء)
            RatingSeeder::class,      // سادساً: التقييمات (تعتمد على العملاء)
        ]);
    }
}

