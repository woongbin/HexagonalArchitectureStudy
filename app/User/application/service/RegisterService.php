<?php

namespace App\User\application\service;

use App\User\application\port\in\RegisterCommand;
use App\User\application\port\in\useCase\RegisterUseCase;
use App\User\application\port\out\CheckDuplicateEmailPort;
use App\User\application\port\out\RegisterPort;
use App\User\domain\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Throwable;

class RegisterService implements RegisterUseCase
{
    protected CheckDuplicateEmailPort $checkDuplicateEmailPort;

    protected RegisterPort $registerPort;

    /**
     * @param CheckDuplicateEmailPort $checkDuplicateEmailPort
     * @param RegisterPort $registerPort
     */
    public function __construct(
        CheckDuplicateEmailPort $checkDuplicateEmailPort,
        RegisterPort $registerPort
    ) {
        $this->checkDuplicateEmailPort = $checkDuplicateEmailPort;
        $this->registerPort = $registerPort;
    }

    /**
     * @param RegisterCommand $command
     * @return User
     * @throws Throwable
     */
    public function register(RegisterCommand $command): User
    {
        $email = $command->getEmail();
        $password = $command->getPassword();
        $name = $command->getName();

        if ($this->checkDuplicateEmailPort->checkDuplicateEmail($email) === true) {
            throw new Exception('이메일 중복');
        }

        DB::beginTransaction();
        try {
            $user = $this->registerPort->register($email, $password, $name);
        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }
        DB::commit();

        return $user;
    }
}
