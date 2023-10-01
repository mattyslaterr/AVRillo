<?php

namespace Tests\Unit\Api;

use App\Jobs\AccountVerification;
use App\Mail\VerifyAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class RegisterControllerApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_can_register_successfully()
    {
        // Fake queue
        Queue::fake();

        // Create verified user account
        $email = fake()->unique()->safeEmail();

        // Test user gets successful response from API
        $this->post(route('api.register'), [
            'name' => fake()->name(),
            'email' => $email,
            'password' => 'test123',
            'password_confirmation' => 'test123'
        ])
            ->assertSuccessful()
            ->assertJsonFragment(['Register successful']);

        // Assert account has been inserted via email
        $this->assertDatabaseHas('users', [
            'email' => $email
        ]);

        // Assert account verification email job is pushed into queue
        Queue::assertPushed(AccountVerification::class);
    }
}
