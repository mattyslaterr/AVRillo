<?php

namespace App\Jobs;

use App\Mail\CustomerBookingMail;
use App\Mail\VerifyAccount;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class AccountVerification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The number of seconds to wait before retrying the job
     * 3600 = 1 hour
     *
     * @var int
     */
    public $backoff = 3600;

    /**
     * User email
     *
     * @var string
     */
    protected string $email;

    /**
     * User account activation token
     *
     * @var string
     */
    protected string $activation_token;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $email, string $activation_token)
    {
        $this->email = $email;
        $this->activation_token = $activation_token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new VerifyAccount($this->activation_token));
    }
}
