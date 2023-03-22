<?php

namespace App\User\adapter\in\web;

use App\Http\Controllers\Controller;
use App\User\adapter\in\web\request\LeaveRequest;
use App\User\adapter\in\web\response\LeaveResponse;
use App\User\application\port\in\LeaveCommand;
use App\User\application\port\in\useCase\LeaveUseCase;

class LeaveController extends Controller
{
    protected LeaveUseCase $leaveUseCase;

    public function __construct(LeaveUseCase $leaveUseCase)
    {
        $this->leaveUseCase = $leaveUseCase;
    }

    public function leave(LeaveRequest $request): LeaveResponse
    {
        $command = new LeaveCommand($request->input('email'), $request->input('password'));

        $this->leaveUseCase->leave($command);

        return LeaveResponse::make([]);
    }
}
