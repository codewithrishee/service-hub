<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);

        $newCount = ContactMessage::where('status', 'new')->count();

        return view('admin.contact-messages.index', compact(
            'messages',
            'newCount'
        ));
    }

    public function show(ContactMessage $contactMessage)
    {
        return view('admin.contact-messages.show', compact(
            'contactMessage'
        ));
    }

    public function updateStatus(
        \Illuminate\Http\Request $request,
        ContactMessage $contactMessage
    ) {
        $validated = $request->validate([
            'status' => 'required|in:new,read,replied',
        ]);

        $contactMessage->update($validated);

        return back()->with(
            'success',
            'Contact message status updated successfully.'
        );
    }

    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()
            ->route('admin.contact-messages.index')
            ->with('success', 'Contact message deleted successfully.');
    }
}
