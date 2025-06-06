<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Telescope\Telescope;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\ApiResponseService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));

        Passport::loadKeysFrom(storage_path('oauth'));

        Passport::hashClientSecrets();

        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));

        Gate::define('viewTelescope', function ($user) {
            return in_array($user->email, [
                'tpnovatitan@gmail.com',
            ]);
        });

        Telescope::auth(function ($request) {
            return auth()->check() && Gate::allows('viewTelescope', auth()->user());
        });
    }
}
