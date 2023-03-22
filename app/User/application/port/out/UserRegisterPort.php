<?php

namespace App\User\application\port\out;

use App\User\domain\User;

interface UserRegisterPort
{
    public function register(string $email, string $password, string $name): User;
}
