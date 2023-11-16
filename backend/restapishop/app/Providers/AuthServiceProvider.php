<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {

            $url = str_replace(
                url('/api/email/verify/'),
                'http://localhost:5173/verify',
                $url
            );

            return (new MailMessage)
                ->subject('Verify Email Address')
                ->line('Click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
        });

        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            $email = $notifiable->getEmailForPasswordReset();
            return 'http://localhost:5173/reset-password?token=' . $token . '&email=' . urlencode($email);
        });


    }

}
