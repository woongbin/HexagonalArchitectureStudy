<?php

namespace App\User\application\port\in\useCase;

use App\User\application\port\in\RegisterCommand;
use App\User\domain\User;

interface RegisterUseCase
{
    public function register(RegisterCommand $command): User;
}
