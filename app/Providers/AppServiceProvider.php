<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */

    public function boot()
    {
        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            $mail = new \App\Mail\EmailVerification($notifiable, $url);
            return $mail;
        });
                
        \Illuminate\Auth\Notifications\ResetPassword::toMailUsing(function ($notifiable, $token) {
            $mail = new \App\Mail\EmailReset($notifiable,
                                              url(route('password.reset', $token, false)));
            return $mail;
        });
    }
}
