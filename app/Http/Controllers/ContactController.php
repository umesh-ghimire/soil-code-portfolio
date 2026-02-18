<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\User;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAutoReply; // Add this import
use App\Mail\NewContactNotification;
use Illuminate\Support\Facades\Log;

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
        
        // ===== SEND AUTO-REPLY TO USER (SENDER) =====
        try {
            Mail::to($message->email)->send(new ContactAutoReply($message));
            Log::info('Auto-reply email sent to: ' . $message->email);
        } catch (\Exception $e) {
            Log::error('Auto-reply email failed: ' . $e->getMessage());
        }
        
        // ===== SEND NOTIFICATION TO ADMIN =====
        $adminEmail = config('mail.admin_email');
        
        if ($adminEmail) {
            try {
                Mail::to($adminEmail)->send(new NewContactNotification($message));
                Log::info('Admin notification sent to: ' . $adminEmail);
            } catch (\Exception $e) {
                Log::error('Admin notification email failed: ' . $e->getMessage());
            }
            
            // Find admin user for Filament notification
            $adminUser = User::where('email', $adminEmail)->first();
            
            if ($adminUser) {
                // Send Filament notification to admin panel
                Notification::make()
                    ->title('🌱 New Message Planted')
                    ->body("From: {$message->name}\nSubject: {$message->subject}")
                    ->success()
                    ->sendToDatabase($adminUser);
            }
        }
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Message sent successfully! I\'ll reply within a moon cycle 🌙',
            ]);
        }
        
        // Redirect to success page
        return redirect()->route('contact.success')
            ->with('success', 'Message sent successfully! I\'ll reply within a moon cycle 🌙');
    }

    /**
     * Display success page after form submission
     */
    public function success()
    {
        return view('contact.success');
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
        // NewsletterSubscriber::create(['email' => $request->email]);
        
        return response()->json([
            'success' => true,
            'message' => 'Subscribed successfully!',
        ]);
    }
}