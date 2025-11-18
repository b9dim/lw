<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\ContactMessage;
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

    public function storeContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
            'g-recaptcha-response' => 'required',
        ]);

        // Verify reCAPTCHA
        $recaptchaSecret = config('services.recaptcha.secret_key');
        if ($recaptchaSecret) {
            $recaptchaResponse = $request->input('g-recaptcha-response');
            $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}");
            $responseData = json_decode($verifyResponse);
            
            if (!$responseData->success) {
                return back()->withErrors(['g-recaptcha-response' => 'فشل التحقق من reCAPTCHA. يرجى المحاولة مرة أخرى.'])->withInput();
            }
        }

        ContactMessage::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'read' => false,
        ]);

        return redirect()->route('contact')->with('success', 'شكراً لك! تم إرسال رسالتك بنجاح وسنتواصل معك قريباً.');
    }
}

