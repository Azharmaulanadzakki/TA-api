<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->createOne();


        $data = [
            'email' => $user->email,
            'password' => 'password',
            'device_name' => 'testing',
        ];


        $this->postJson(route('auth.login'), $data)
            ->assertOk()
            ->assertJsonStructure(['access_token', 'user']);
    }

    
    public function test_user_can_register()
    {
        $data = [
            'name' => 'Tester',
            'email' => 'tester@email.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $this->postJson(route('auth.register'), $data)
            ->assertCreated()
            ->assertJsonFragment(['email' => $data['email']]);
    }
 
}
