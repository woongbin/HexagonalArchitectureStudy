<?php

namespace App\Providers;

use App\User\adapter\out\persistence\RegisterPersistenceAdapter;
use App\User\application\port\in\RegisterUseCase;
use App\User\application\port\out\CheckDuplicateEmailPort;
use App\User\application\port\out\UserRegisterPort;
use App\User\application\service\RegisterService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        app()->bind(RegisterUseCase::class, RegisterService::class);
        app()->bind(CheckDuplicateEmailPort::class, RegisterPersistenceAdapter::class);
        app()->bind(UserRegisterPort::class, RegisterPersistenceAdapter::class);
    }
}
