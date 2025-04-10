<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\NewsletterResource;

class NewsletterController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $subscribers = Subscriber::where('status', 'subscribed')->pluck('email');

        foreach ($subscribers as $email) {
            Mail::raw($validated['content'], function ($message) use ($email, $validated) {
                $message->to($email)
                    ->subject($validated['subject']);
            });
        }

        return response()->json([
            'message' => 'Newsletter sent to all active subscribers.'
        ], 200);
    }
}
