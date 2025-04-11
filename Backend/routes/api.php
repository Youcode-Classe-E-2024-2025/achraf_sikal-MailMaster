<?php

use Kyojin\JWT\Facades\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\SubscriberController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);

Route::middleware('jwt')->group(function () {
    Route::get('/me', function (Request $request) {
        $token = $request->bearerToken(); //accessing the token from the header
        $payload = JWT::decode($token); //decoding the token for the payload

        return response()->json([
            'user' => Auth::user(), //accessing the logged in user based on the token
            'payload' => $payload,
        ]);
    });
    Route::apiResource('subscribers', SubscriberController::class);
    Route::post('newsletters', [NewsletterController::class,'send']);
    Route::apiResource('campaigns', CampaignController::class);
});
Route::post('/login', [AuthController::class, 'login']);
Route::post('/send', [NewsletterController::class, 'send']);
