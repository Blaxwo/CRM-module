<?php

namespace App\Jobs;

use App\Mail\WelcomeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Exception;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $tries = 3;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        try {
            Mail::to($this->user->email)->send(new WelcomeEmail($this->user));

        } catch (Exception $e) {
            throw $e;
        }
    }

    public function failed(Exception $exception)
    {
        Log::error("Failed to send welcome email to {$this->user->email}. Error: {$exception->getMessage()}");
    }
}
