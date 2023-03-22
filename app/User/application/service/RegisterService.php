<?php

namespace App\User\application\service;

use App\User\application\port\in\RegisterCommand;
use App\User\application\port\in\RegisterUseCase;
use App\User\application\port\out\CheckDuplicateEmailPort;
use App\User\application\port\out\UserRegisterPort;
use App\User\domain\User;
use Exception;

class RegisterService implements RegisterUseCase
{
    protected CheckDuplicateEmailPort $checkDuplicateEmailPort;

    protected UserRegisterPort $userRegisterPort;

    /**
     * @param CheckDuplicateEmailPort $checkDuplicateEmailPort
     * @param UserRegisterPort $userRegisterPort
     */
    public function __construct(
        CheckDuplicateEmailPort $checkDuplicateEmailPort,
        UserRegisterPort $userRegisterPort
    ) {
        $this->checkDuplicateEmailPort = $checkDuplicateEmailPort;
        $this->userRegisterPort = $userRegisterPort;
    }

    /**
     * @throws Exception
     */
    public function register(RegisterCommand $command): User
    {
        $email = $command->getEmail();
        $password = $command->getPassword();
        $name = $command->getName();

        if ($this->checkDuplicateEmailPort->checkDuplicateEmail($email) === true) {
            throw new Exception('이메일 중복');
        }

        return $this->userRegisterPort->register($email, $password, $name);
    }
}
