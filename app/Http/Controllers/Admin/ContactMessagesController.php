<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('admin.contact-messages.index', compact('messages'));
    }

    public function show(ContactMessage $contactMessage)
    {
        // تحديد الرسالة كمقروءة عند عرضها
        if (!$contactMessage->read) {
            $contactMessage->update(['read' => true]);
        }
        
        return view('admin.contact-messages.show', compact('contactMessage'));
    }

    public function markAsRead(ContactMessage $contactMessage)
    {
        $contactMessage->update(['read' => true]);
        return redirect()->back()->with('success', 'تم تحديد الرسالة كمقروءة.');
    }

    public function markAsUnread(ContactMessage $contactMessage)
    {
        $contactMessage->update(['read' => false]);
        return redirect()->back()->with('success', 'تم تحديد الرسالة كغير مقروءة.');
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();
        return redirect()->route('admin.contact-messages.index')->with('success', 'تم حذف الرسالة بنجاح.');
    }
}

