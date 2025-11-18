<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Case_;
use App\Models\Inquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    public function index()
    {
        $client = Auth::guard('client')->user();
        
        // عرض جميع قضايا العميل مع تحديد الأعمدة المطلوبة فقط
        $cases = $client->cases()
            ->with([
                'inquiries:id,case_id,message,created_at'
            ])
            ->select('id', 'case_number', 'status', 'created_at', 'last_update_text')
            ->latest()
            ->get();

        return view('client.dashboard', compact('cases'));
    }

    public function showCase($id)
    {
        $client = Auth::guard('client')->user();
        
        // التحقق من أن القضية تخص العميل
        $case = Case_::where('client_id', $client->id)->findOrFail($id);
        
        $inquiries = $case->inquiries()->orderBy('created_at', 'desc')->get();

        return view('client.case-details', compact('case', 'inquiries'));
    }

    public function storeInquiry(Request $request, $caseId)
    {
        $client = Auth::guard('client')->user();
        $case = Case_::where('client_id', $client->id)->findOrFail($caseId);

        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        Inquiry::create([
            'case_id' => $case->id,
            'client_id' => $client->id,
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'تم إرسال الاستفسار بنجاح.');
    }

}

