<?php

namespace App\User\adapter\out\persistence;

use App\User\domain\User;

class UserRepository
{
    public function findByEmail(string $email): ?User
    {
        return User::query()
            ->where('email', $email)
            ->get()
            ->first();
    }

    public function checkDuplicateEmail(string $email): bool
    {
        return User::query()
            ->where('email', $email)
            ->exists();
    }

    public function store(User $user): User
    {
        $user->save();

        return $user;
    }
}
