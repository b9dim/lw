<?php

namespace Tests\Feature;

use App\Models\Case_;
use App\Models\Client;
use App\Models\Inquiry;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class InquiryFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_submit_inquiry(): void
    {
        $client = Client::create([
            'name' => 'عميل تجريبي',
            'national_id' => '1234567890',
            'phone' => '0500000000',
            'email' => 'client@example.com',
            'password' => Hash::make('secret123'),
        ]);

        $lawyer = User::create([
            'name' => 'محامي',
            'email' => 'lawyer@example.com',
            'password' => Hash::make('secret123'),
            'role' => 'محامي',
        ]);

        $case = Case_::create([
            'case_number' => 'CASE-TEST-001',
            'client_id' => $client->id,
            'lawyer_id' => $lawyer->id,
            'court_name' => 'محكمة الرياض',
            'status' => 'قيد المعالجة',
            'description' => 'تفاصيل القضية التجريبية',
        ]);

        $response = $this->actingAs($client, 'client')->post(
            route('client.cases.inquiries.store', $case->id),
            ['message' => 'ما هو موعد الجلسة القادمة؟']
        );

        $response->assertRedirect();

        $this->assertDatabaseHas('inquiries', [
            'case_id' => $case->id,
            'client_id' => $client->id,
            'message' => 'ما هو موعد الجلسة القادمة؟',
        ]);
    }

    public function test_admin_can_reply_to_inquiry(): void
    {
        $client = Client::create([
            'name' => 'عميل آخر',
            'national_id' => '0987654321',
            'phone' => '0501111111',
            'email' => 'client2@example.com',
            'password' => Hash::make('secret123'),
        ]);

        $admin = User::create([
            'name' => 'مدير النظام',
            'email' => 'admin@example.com',
            'password' => Hash::make('secret123'),
            'role' => 'مدير',
        ]);

        $case = Case_::create([
            'case_number' => 'CASE-TEST-002',
            'client_id' => $client->id,
            'lawyer_id' => null,
            'court_name' => 'محكمة جدة',
            'status' => 'قيد المحاكمة',
            'description' => 'قضية تجريبية ثانية',
        ]);

        $inquiry = Inquiry::create([
            'case_id' => $case->id,
            'client_id' => $client->id,
            'message' => 'هل تم تحديد موعد جديد؟',
        ]);

        $response = $this->actingAs($admin)->post(
            route('admin.inquiries.reply', $inquiry->id),
            ['reply' => 'نعم، الجلسة في 25 مارس.']
        );

        $response->assertRedirect();

        $this->assertDatabaseHas('inquiries', [
            'id' => $inquiry->id,
            'reply' => 'نعم، الجلسة في 25 مارس.',
        ]);
    }
}
