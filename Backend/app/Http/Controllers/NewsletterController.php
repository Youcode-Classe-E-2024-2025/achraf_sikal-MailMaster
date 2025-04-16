<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    public function send()
    {
        $newsletter = Newsletter::latest()->first();

        if (!$newsletter) {
            return response()->json([
                'message' => 'No newsletter found.'
            ], 404);
        }

        $subscribers = User::all(['email']);

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new Newslettere($newsletter->title, $newsletter->content));
        }

        return response()->json([
            'message' => 'Newsletter sent to all subscribers.'
        ], 200);
    }
}
