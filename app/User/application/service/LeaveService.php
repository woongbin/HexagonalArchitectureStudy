<?php

namespace App\User\application\service;

use App\User\application\port\in\LeaveCommand;
use App\User\application\port\in\useCase\LeaveUseCase;
use App\User\application\port\out\FindByEmailPort;
use App\User\application\port\out\LeavePort;
use App\User\domain\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class LeaveService implements LeaveUseCase
{
    protected FindByEmailPort $checkExistEmailPort;

    protected LeavePort $leavePort;

    public function __construct(FindByEmailPort $checkExistEmailPort, LeavePort $leavePort)
    {
        $this->checkExistEmailPort = $checkExistEmailPort;
        $this->leavePort = $leavePort;
    }

    /**
     * @param LeaveCommand $command
     * @return User
     * @throws Throwable
     */
    public function leave(LeaveCommand $command): User
    {
        $email = $command->getEmail();
        $password = $command->getPassword();

        $user = $this->checkExistEmailPort->findByEmail($email);
        if ($user === null) {
            throw new Exception('존재하지 않는 유저');
        }

        if ($user->checkExistPassword($password) === false) {
            throw new Exception('비밀번호가 맞지 않습니다.');
        }

        DB::beginTransaction();
        try {
            $deletedUser = $this->leavePort->leave($user);
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }
        DB::commit();

        return $deletedUser;
    }
}
