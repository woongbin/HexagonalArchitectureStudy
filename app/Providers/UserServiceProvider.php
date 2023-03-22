<?php

namespace App\Providers;

use App\User\adapter\out\persistence\LeavePersistenceAdapter;
use App\User\adapter\out\persistence\RegisterPersistenceAdapter;
use App\User\application\port\in\useCase\LeaveUseCase;
use App\User\application\port\in\useCase\RegisterUseCase;
use App\User\application\port\out\CheckDuplicateEmailPort;
use App\User\application\port\out\FindByEmailPort;
use App\User\application\port\out\LeavePort;
use App\User\application\port\out\RegisterPort;
use App\User\application\service\LeaveService;
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
        app()->bind(RegisterPort::class, RegisterPersistenceAdapter::class);

        app()->bind(LeaveUseCase::class, LeaveService::class);
        app()->bind(FindByEmailPort::class, LeavePersistenceAdapter::class);
        app()->bind(LeavePort::class, LeavePersistenceAdapter::class);
    }
}
