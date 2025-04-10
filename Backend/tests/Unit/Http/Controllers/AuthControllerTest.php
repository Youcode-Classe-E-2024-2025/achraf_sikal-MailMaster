<?php
declare(strict_types=1);
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);
it('register User Token', function (): void {
    $response = $this->postJson('/api/register', [
        'name' => 'Test',
        'email' => 'Test@example.com',
        'password' => 'password123',
    ]);

    $response->assertStatus(200)
    ->assertJsonStructure([
        'user' => ['id', 'name', 'email', 'created_at', 'updated_at'],
        'token'
    ]);

    $this->assertDatabaseHas('users', [
        'email' => 'Test@example.com',
    ]);
});

it('login User Token', function (): void {
    $user = UserFactory::new()->create();

    $request = [
        "email" => $user->email,
        "password" => "password",
    ];
    $response = $this->postJson('/api/login', $request);

    $response->assertStatus(200)
    ->assertJsonStructure([
        'user',
        'token'
    ]);
});
