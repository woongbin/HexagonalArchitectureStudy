<?php

namespace App\User\adapter\out\persistence;

use App\User\application\port\out\CheckDuplicateEmailPort;
use App\User\application\port\out\UserRegisterPort;
use App\User\domain\User;

class RegisterPersistenceAdapter implements CheckDuplicateEmailPort, UserRegisterPort
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function checkDuplicateEmail(string $email): bool
    {
        return $this->repository->checkDuplicateEmail($email);
    }

    public function register(string $email, string $password, string $name): User
    {
        $newUser = new User();
        $newUser->email = $email;
        $newUser->password = $password;
        $newUser->name = $name;

        return $this->repository->store($newUser);
    }
}
