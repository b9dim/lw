<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $ratings = Rating::where('status', 'approved')
            ->with('client')
            ->latest()
            ->take(6)
            ->get();
        
        return view('public.home', compact('ratings'));
    }

    public function about()
    {
        return view('public.about');
    }

    public function services()
    {
        return view('public.services');
    }

    public function contact()
    {
        return view('public.contact');
    }
}

