<?php

namespace App\User\application\port\in;

use App\User\domain\User;

interface RegisterUseCase
{
    public function register(RegisterCommand $command): User;
}
