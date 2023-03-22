<?php

namespace App\User\application\port\out;

use App\User\domain\User;

interface LeavePort
{
    public function leave(User $user): User;
}
