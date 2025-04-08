<?php

declare(strict_types=1);

test('User Token', function (): void {
    $user = App\Models\User::factory()->create()->fresh();

    $token = $user->createToken();
    // dd($token);
    $data = json_encode([
        'user' => $user,
        'token' => $token
    ]);

    $decoded = json_decode( $data,  true)['token'];

    expect($decoded)
    ->toBe($token);

});
