<?php

namespace App\Application\Providers;

use App\Domain\Services\Transaction\Validators\ExternalAuthorizerService;
use Illuminate\Support\ServiceProvider;

class EnvServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ExternalAuthorizerService::class, function() {
            return new ExternalAuthorizerService(env('EXTERNAL_AUTHORIZER_URL'));
        });
    }
}
