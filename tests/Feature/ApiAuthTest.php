<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ApiAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login_via_email_on_api(): void
    {
        $user = User::factory()->create([
            'email' => 'sandeep198558@gmail.com',
            'mobile' => '9664588677',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'login' => 'sandeep198558@gmail.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['status', 'token', 'token_type', 'user']);
    }

    public function test_user_can_login_via_mobile_on_api(): void
    {
        $user = User::factory()->create([
            'email' => 'leenaadam28@gmail.com',
            'mobile' => '9769409405',
            'password' => Hash::make('password'),
        ]);

        $response = $this->postJson('/api/login', [
            'login' => '9769409405',
            'password' => 'password',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['status', 'token', 'token_type', 'user']);
    }
}
