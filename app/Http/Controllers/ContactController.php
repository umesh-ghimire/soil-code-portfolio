<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;

class ContactController extends Controller
{
    /**
     * Display the contact page
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Store a new contact message
     */
    public function store(ContactRequest $request)
    {
        $validated = $request->validated();
        
        // Add IP and user agent
        $validated['ip_address'] = $request->ip();
        $validated['user_agent'] = $request->userAgent();
        
        $message = ContactMessage::create($validated);
        
        // Send email notification to admin
        // Mail::to(config('mail.admin_address'))->send(new NewContactMessage($message));
        
        // Send auto-reply to user
        // Mail::to($message->email)->send(new ContactAutoReply($message));
        
        // Send Filament notification to admin panel
        Notification::make()
            ->title('New Contact Message')
            ->body("From: {$message->name}\nSubject: {$message->subject}")
            ->success()
            ->sendToDatabase(\App\Models\User::where('email', config('mail.admin_email'))->first());
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully! I\'ll reply within a moon cycle 🌙',
            ]);
        }
        
        return back()->with('success', 'Message sent successfully! I\'ll reply within a moon cycle 🌙');
    }

    /**
     * Subscribe to newsletter
     */
    public function newsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);
        
        // Newsletter subscription logic
        
        return response()->json([
            'success' => true,
            'message' => 'Subscribed successfully!',
        ]);
    }
}