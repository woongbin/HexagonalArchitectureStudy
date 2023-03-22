<?php

namespace App\User\adapter\in\web;

use App\Http\Controllers\Controller;
use App\User\adapter\in\web\request\RegisterRequest;
use App\User\adapter\in\web\response\RegisterResponse;
use App\User\application\port\in\RegisterCommand;
use App\User\application\port\in\RegisterUseCase;

class RegisterController extends Controller
{
    protected RegisterUseCase $registerUseCase;

    public function __construct(RegisterUseCase $registerUseCase)
    {
        $this->registerUseCase = $registerUseCase;
    }

    public function register(RegisterRequest $request): RegisterResponse
    {
        $registerCommand = new RegisterCommand(
            $request->input('email'),
            $request->input('password'),
            $request->input('name')
        );

        $user = $this->registerUseCase->register($registerCommand);

        return RegisterResponse::make($user);
    }
}
