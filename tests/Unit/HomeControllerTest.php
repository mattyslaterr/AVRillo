<?php

namespace Tests\Unit;

 use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_authed_and_verified_user_can_view_dashboard()
    {
        // Create verified user account
        $user = User::factory()->create();

        // Test user can see dashboard successfully
        $this->actingAs($user)->get(route('dashboard'))
            ->assertViewIs('home')
            ->assertSuccessful();
    }

    /**
     * @test
     */
    public function test_authed_and_unverified_user_can_not_see_dashboard()
    {
        // Create unverified user account
        $user = User::factory()->unverified()->create();

        // Test user gets redirect to login page due to unverified account
        $this->actingAs($user)->get(route('dashboard'))
            ->assertRedirect('/login');
    }

    /**
     * @test
     */
    public function test_guest_user_can_not_see_dashboard()
    {
        // Test no user (no auth) gets redirect to login page
        $this->get(route('dashboard'))
            ->assertRedirect('/login');
    }
}
