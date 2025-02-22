<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as VerifyEmailBase;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;

class VerifyEmail extends VerifyEmailBase
{
    use Queueable;

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Verifica il tuo indirizzo email - Compendium Keeper')
            ->view('emails.verify', [
                'url' => $this->verificationUrl($notifiable),
                'name' => $notifiable->username
            ]);
    }
}