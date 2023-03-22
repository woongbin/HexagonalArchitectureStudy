<?php

namespace App\User\application\port\in\useCase;

use App\User\application\port\in\LeaveCommand;
use App\User\domain\User;

interface LeaveUseCase
{
    public function leave(LeaveCommand $command): User;
}
