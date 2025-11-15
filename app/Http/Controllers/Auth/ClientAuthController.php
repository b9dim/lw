<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ClientAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('public.client-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'national_id' => 'required|digits:10',
            'password' => 'required|string',
        ], [
            'national_id.digits' => 'يجب أن يكون رقم الهوية 10 أرقام بالضبط.',
            'national_id.required' => 'رقم الهوية مطلوب.',
        ]);

        $credentials = [
            'national_id' => $request->national_id,
            'password' => $request->password,
        ];

        if (Auth::guard('client')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            return redirect()->route('client.dashboard');
        }

        throw ValidationException::withMessages([
            'national_id' => ['رقم الهوية أو الرقم السري غير صحيح.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

