<?php

namespace App\User\application\port\in;

class RegisterCommand
{
    protected string $email;

    protected string $password;

    protected string $name;

    /**
     * @param string $email
     * @param string $password
     * @param string $name
     */
    public function __construct(string $email, string $password, string $name)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
