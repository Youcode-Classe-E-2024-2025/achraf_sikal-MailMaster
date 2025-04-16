<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function send()
    {
        $subscribers = User::all("email");

        foreach ($subscribers as $subscriber) {
            Mail::raw("cccccccccccccccc", function ($message) use ($subscriber) {
                $message->to($subscriber->email)
                    ->subject("sssssssssssssssss");
            });
        }

        return response()->json([
            'message' => 'Newsletter sent to all active subscribers.'
        ], 200);
    }
}
