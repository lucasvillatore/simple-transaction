<?php

namespace App\Application\Providers;

use App\Domain\Services\Notification\NotificationService;
use App\Domain\Services\Transaction\TransactionService;
use App\Domain\Services\Transaction\Validators\ExternalAuthorizerService;
use App\Domain\Services\User\UserService;
use App\Infrastructure\Repositories\Notification\NotificationRepository;
use App\Infrastructure\Repositories\Transaction\TransactionRepository;
use App\Infrastructure\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NotificationService::class, function() {
            return new NotificationService(new NotificationRepository, env('NOTIFICATION_URL'));
        });
        $this->app->bind(TransactionService::class, function() {
            return new TransactionService(
                new TransactionRepository(new ExternalAuthorizerService(env('EXTERNAL_AUTHORIZER_URL'))),
                new UserService(new UserRepository),
                new NotificationService(new NotificationRepository, env('NOTIFICATION_URL'))
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
