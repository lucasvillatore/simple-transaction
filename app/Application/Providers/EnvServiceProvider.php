<?php

namespace App\Application\Providers;

use App\Domain\Services\Notification\NotificationService;
use App\Domain\Services\Transaction\Validators\ExternalAuthorizerService;
use App\Infrastructure\Repositories\Notification\NotificationRepository;
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

        $this->app->bind(NotificationService::class, function() {
            return new NotificationService(new NotificationRepository, env('NOTIFICATION_URL'));
        });
    }
}
