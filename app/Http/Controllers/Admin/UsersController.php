<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::latest()->paginate(15);
        $adminCount = User::where('role', 'مدير')->count();
        return view('admin.users.index', compact('users', 'adminCount'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:مدير,محامي,موظف استقبال',
        ], [
            'password.min' => 'يجب أن تكون كلمة المرور 8 أحرف على الأقل.',
            'password.string' => 'يجب أن تكون كلمة المرور نصاً.',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('admin.users.index')->with('success', 'تم إضافة المستخدم بنجاح.');
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:مدير,محامي,موظف استقبال',
        ], [
            'password.min' => 'يجب أن تكون كلمة المرور 8 أحرف على الأقل.',
            'password.string' => 'يجب أن تكون كلمة المرور نصاً.',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')->with('success', 'تم تحديث بيانات المستخدم بنجاح.');
    }

    public function destroy(User $user)
    {
        if ($user->isAdmin() && User::where('role', 'مدير')->count() <= 1) {
            return redirect()->back()->with('error', 'لا يمكن حذف المدير الوحيد في النظام.');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'تم حذف المستخدم بنجاح.');
    }
}

