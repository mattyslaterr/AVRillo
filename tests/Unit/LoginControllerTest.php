<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_authed_and_unverified_user_can_view_login()
    {
        // Create unverified user account
        $user = User::factory()->unverified()->create();

        // Test user can see login even if authed, but is unverified
        $this->actingAs($user)->get(route('login'))
            ->assertSuccessful();
    }

    /**
     * @test
     */
    public function test_authed_and_verified_user_can_not_view_login()
    {
        // Create verified user account
        $user = User::factory()->create();

        // Test user gets redirect to dashboard page due to being logged in
        $this->actingAs($user)->get(route('login'))
            ->assertRedirect('/');
    }

    /**
     * @test
     */
    public function test_guest_can_view_login()
    {
        // Test no user (no auth) can view login
        $this->get(route('login'))
            ->assertSuccessful();
    }
}
