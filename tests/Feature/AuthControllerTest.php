<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testLoginSuccessfully(): void
    {
        $user = User::create([
            'name' => 'Admin Bagus',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);

        $credentials = [
            'email' => $user->email,
            'password' => 'admin',
        ];

        $response = $this->post('/login', $credentials);

        $response->assertStatus(302);
        $this->assertAuthenticatedAs($user);
    }
}
