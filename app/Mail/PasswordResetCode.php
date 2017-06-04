<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\PasswordReset as PasswordReset;

class PasswordResetCode extends Mailable
{

    use Queueable,
        SerializesModels;

    /**
     * The PasswordReset instance.
     *
     * @var PasswordReset
     */
    public $password_reset;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PasswordReset $password_reset)
    {
        $this->password_reset = $password_reset;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.password_rest_code');
    }
}
