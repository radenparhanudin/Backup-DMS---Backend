<?php

namespace App\Providers;

use App\Helpers\ConvertHelper;
use App\Helpers\DMSHelper;
use App\Helpers\ResponseJsonHelper;
use App\Models\PersonalAccessToken;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

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
        $this->app->bind('response-json', function () {
            return new ResponseJsonHelper();
        });
        $this->app->bind('dms', function () {
            return new DMSHelper();
        });
        $this->app->bind('convert', function () {
            return new ConvertHelper();
        });

        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
