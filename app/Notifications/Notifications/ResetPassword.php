<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordBase;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends ResetPasswordBase
{
    use Queueable;

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reimposta la tua password - Compendium Keeper')
            ->view('emails.reset-password', [
                'url' => url(route('password.reset', [
                    'token' => $this->token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ], false)),
                'name' => $notifiable->name
            ]);
    }
}