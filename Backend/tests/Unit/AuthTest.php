<?php

declare(strict_types=1);

test(description: 'User Token', closure: function (): void {
    $user = App\Models\User::factory()->create()->refresh();

    $token = $user->createToken(); //creating token

    $data = json_encode(value: [
        'user' => $user,
        'token' => $token
    ]);
    $decoded = json_decode(json: $data, associative: true)['token'];

    expect(value: $decoded)
    ->toBe(expected: $token);

});
