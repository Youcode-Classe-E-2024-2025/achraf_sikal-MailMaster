<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $subscribers = User::all()->pluck('email');

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
