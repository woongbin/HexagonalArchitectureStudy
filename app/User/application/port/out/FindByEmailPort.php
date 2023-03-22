<?php

namespace App\User\application\port\out;

use App\User\domain\User;

interface FindByEmailPort
{
    public function findByEmail(string $email): ?User;
}
