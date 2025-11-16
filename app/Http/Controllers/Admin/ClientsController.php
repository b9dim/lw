<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $clients = Client::with('cases')->latest()->paginate(15);
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'required|digits:10|unique:clients,national_id',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'password' => 'required|string|min:8',
        ], [
            'national_id.digits' => 'يجب أن يكون رقم الهوية 10 أرقام بالضبط.',
            'national_id.required' => 'رقم الهوية مطلوب.',
            'national_id.unique' => 'رقم الهوية مستخدم مسبقاً.',
            'password.min' => 'يجب أن تكون كلمة المرور 8 أحرف على الأقل.',
            'password.string' => 'يجب أن تكون كلمة المرور نصاً.',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        Client::create($validated);

        return redirect()->route('admin.clients.index')->with('success', 'تم إضافة العميل بنجاح.');
    }

    public function show(Client $client)
    {
        $client->load('cases.lawyer', 'cases.updates');
        return view('admin.clients.show', compact('client'));
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'national_id' => 'required|digits:10|unique:clients,national_id,' . $client->id,
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'password' => 'nullable|string|min:8',
        ], [
            'national_id.digits' => 'يجب أن يكون رقم الهوية 10 أرقام بالضبط.',
            'national_id.required' => 'رقم الهوية مطلوب.',
            'national_id.unique' => 'رقم الهوية مستخدم مسبقاً.',
            'password.min' => 'يجب أن تكون كلمة المرور 8 أحرف على الأقل.',
            'password.string' => 'يجب أن تكون كلمة المرور نصاً.',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $client->update($validated);

        return redirect()->route('admin.clients.index')->with('success', 'تم تحديث بيانات العميل بنجاح.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'تم حذف العميل بنجاح.');
    }
}

