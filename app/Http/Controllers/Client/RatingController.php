<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    public function create()
    {
        $client = Auth::guard('client')->user();
        
        // التحقق من وجود تقييم معلق أو معتمد مسبقاً
        $existingRating = Rating::where('client_id', $client->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        return view('client.ratings.create', compact('existingRating'));
    }

    public function store(Request $request)
    {
        $client = Auth::guard('client')->user();

        // التحقق من وجود تقييم معلق أو معتمد مسبقاً
        $existingRating = Rating::where('client_id', $client->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingRating) {
            return redirect()->back()->with('error', 'لديك تقييم معلق أو معتمد مسبقاً.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ], [
            'rating.required' => 'يرجى اختيار التقييم.',
            'rating.integer' => 'التقييم يجب أن يكون رقماً.',
            'rating.min' => 'التقييم يجب أن يكون على الأقل 1.',
            'rating.max' => 'التقييم يجب أن يكون على الأكثر 5.',
            'comment.max' => 'التعليق يجب أن يكون أقل من 1000 حرف.',
        ]);

        Rating::create([
            'client_id' => $client->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->secure(route('client.dashboard'))->with('success', 'تم إرسال التقييم بنجاح. سيتم مراجعته من قبل الإدارة.');
    }
}

