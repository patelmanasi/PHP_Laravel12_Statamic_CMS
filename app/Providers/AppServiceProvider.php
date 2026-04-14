<?php

namespace App\Providers;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(Login::class, function ($event) {
            $user = User::find($event->user->id);

            if ($user) {
                $user->last_login = now();
                $user->save();
            }
        });
    }
}
