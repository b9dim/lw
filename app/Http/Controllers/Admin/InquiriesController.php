<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $inquiries = Inquiry::with(['case', 'client'])->latest()->paginate(15);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(Inquiry $inquiry)
    {
        $inquiry->load(['case', 'client']);
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function reply(Request $request, Inquiry $inquiry)
    {
        $validated = $request->validate([
            'reply' => 'required|string|max:2000',
        ]);

        $inquiry->update([
            'reply' => $validated['reply'],
            'replied_at' => now(),
        ]);

        return redirect()->back()->with('success', 'تم إرسال الرد بنجاح.');
    }
}

