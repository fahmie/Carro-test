<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginAPI extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testUserCanLoginWithCorrectCredentials()
    {
        $user = factory(User::class)->create([
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password'),
        ]);
    
        $response = $this->post('/api/login', [
            'email' => 'johndoe@example.com',
            'password' => 'password',
        ]);
    
        $response->assertStatus(200);
        $response->assertJsonStructure(['access_token', 'token_type', 'expires_in']);
    }

    public function testUserCannotLoginWithIncorrectCredentials()
    {
        $user = factory(User::class)->create([
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/api/login', [
            'email' => 'johndoe@example.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401);
        $response->assertJson(['error' => 'Unauthorized']);
    }


    public function testUserCanLogout()
    {
        $user = factory($class)(User::class)->create([
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password'),
        ]);

        $token = $user->createToken('TestToken')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->post('/api/logout');

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Successfully logged out']);
    }

    public function testUserCanGetProfileInformationAfterLoggingIn()
    {
        $user = factory(User::class)->create([
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password'),
        ]);

        $token = $user->createToken('TestToken')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->get('/api/user');

        $response->assertStatus(200);
        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }
}
