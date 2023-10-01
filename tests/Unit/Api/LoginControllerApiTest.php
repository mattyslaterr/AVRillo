<?php

namespace Tests\Unit\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class LoginControllerApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_verified_account_can_login_successfully()
    {
        // Create verified user account
        $user = User::factory()->create();

        // Test user gets successful response from API
        $this->post(route('api.login'), [
            'email' => $user->email,
            'password' => 'password' // Send in raw pwd set in UserFactory
        ])
            ->assertSuccessful()
            ->assertJsonFragment(['Login success']);

        // Check user is now authenticated
        $this->assertAuthenticated();
    }

    /**
     * @test
     */
    public function test_unverified_account_can_not_login_successfully()
    {
        // Create unverified user account
        $user = User::factory()->unverified()->create();

        // Test user gets unsuccessful response from API
        $this->post(route('api.login'), [
            'email' => $user->email,
            'password' => 'password' // Send in raw pwd set in UserFactory
        ])
            ->assertStatus(422)
            ->assertJson(['You must verify your account before logging in']);

        // Check user is not authenticated
        $this->assertGuest();
    }
}
