<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Case_;
use App\Models\Client;
use App\Models\Inquiry;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $stats = [
            'total_cases' => Case_::count(),
            'active_cases' => Case_::whereIn('status', ['قيد المعالجة', 'قيد المحاكمة'])->count(),
            'total_clients' => Client::count(),
            'pending_inquiries' => Inquiry::whereNull('reply')->count(),
            'pending_ratings' => Rating::where('status', 'pending')->count(),
        ];

        // تحديد الأعمدة المطلوبة فقط لتحسين الأداء
        $recentCases = Case_::with(['client:id,name', 'lawyer:id,name'])
            ->select('id', 'case_number', 'client_id', 'lawyer_id', 'status', 'created_at')
            ->latest()
            ->take(5)
            ->get();
        
        $recentInquiries = Inquiry::with(['case:id,case_number', 'client:id,name'])
            ->select('id', 'case_id', 'client_id', 'message', 'created_at')
            ->whereNull('reply')
            ->latest()
            ->take(5)
            ->get();
        
        $recentRatings = Rating::with('client:id,name')
            ->select('id', 'client_id', 'rating', 'comment', 'created_at')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentCases', 'recentInquiries', 'recentRatings'));
    }
}

