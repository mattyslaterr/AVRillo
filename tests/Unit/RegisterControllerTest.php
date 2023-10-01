<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_authed_and_unverified_user_can_view_register()
    {
        // Create unverified user account
        $user = User::factory()->unverified()->create();

        // Test user can see register even if authed, but is unverified
        $this->actingAs($user)->get(route('register'))
            ->assertSuccessful();
    }

    /**
     * @test
     */
    public function test_authed_and_verified_user_can_not_view_register()
    {
        // Create verified user account
        $user = User::factory()->create();

        // Test user gets redirect to dashboard page due to being logged in
        $this->actingAs($user)->get(route('register'))
            ->assertRedirect('/');
    }

    /**
     * @test
     */
    public function test_guest_can_view_register()
    {
        // Test no user (no auth) can view register
        $this->get(route('register'))
            ->assertSuccessful();
    }

    /**
     * @test
     */
    public function test_guest_can_view_activate_account()
    {
        // Test no user (no auth) can view account activation
        $this->get(route('activate'))
            ->assertSuccessful();
    }

    /**
     * @test
     */
    public function test_authed_and_unverified_user_can_view_activate_account()
    {
        // Create unverified user account
        $user = User::factory()->unverified()->create();

        // Test user can see activate even if authed, but is unverified
        $this->actingAs($user)->get(route('activate'))
            ->assertSuccessful();
    }

    /**
     * @test
     */
    public function test_authed_and_verified_user_can_not_view_activate_account()
    {
        // Create verified user account
        $user = User::factory()->create();

        // Test user gets redirect to dashboard page due to being logged in
        $this->actingAs($user)->get(route('activate'))
            ->assertRedirect('/');
    }

    /**
     * @test
     */
    public function test_can_verify_account()
    {
        // Create unverified user account
        $user = User::factory()->unverified()->create();

        // Test user can verify account with token
        $this->get(route('activate', [
            'token' => $user->activation_token
        ]))->assertSuccessful();

        // Refresh model
        $user->refresh();

        // Assert activation token has been nulled and email verified at has been set
        $this->assertTrue($user->activation_token === null);
        $this->assertNotNull($user->email_verified_at);
    }
}
