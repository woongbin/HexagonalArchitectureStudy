<?php

namespace App\User\application\port\out;

interface CheckDuplicateEmailPort
{
    public function checkDuplicateEmail(string $email): bool;
}
