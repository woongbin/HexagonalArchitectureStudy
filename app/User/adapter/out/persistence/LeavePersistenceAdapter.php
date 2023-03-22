<?php

namespace App\User\adapter\out\persistence;

use App\User\application\port\out\FindByEmailPort;
use App\User\application\port\out\LeavePort;
use App\User\domain\User;

class LeavePersistenceAdapter implements FindByEmailPort, LeavePort
{
    protected UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function findByEmail(string $email): ?User
    {
        return $this->repository->findByEmail($email);
    }

    public function leave(User $user): User
    {
        $user->delete();

        return $user;
    }
}
