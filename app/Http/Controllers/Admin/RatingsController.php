<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $ratings = Rating::with('client')->latest()->paginate(15);
        $pendingCount = Rating::where('status', 'pending')->count();
        $approvedCount = Rating::where('status', 'approved')->count();
        $rejectedCount = Rating::where('status', 'rejected')->count();

        return view('admin.ratings.index', compact('ratings', 'pendingCount', 'approvedCount', 'rejectedCount'));
    }

    public function approve(Rating $rating)
    {
        $rating->update(['status' => 'approved']);

        return redirect()->route('admin.ratings.index')->with('success', 'تم الموافقة على تقييم العميل ' . $rating->client->name . ' بنجاح');
    }

    public function reject(Rating $rating)
    {
        $rating->update(['status' => 'rejected']);

        return redirect()->route('admin.ratings.index')->with('success', 'تم رفض تقييم العميل ' . $rating->client->name . ' بنجاح');
    }

    public function destroy(Rating $rating)
    {
        $clientName = $rating->client->name;
        $rating->delete();

        return redirect()->route('admin.ratings.index')->with('success', 'تم حذف تقييم العميل ' . $clientName . ' بنجاح');
    }
}

