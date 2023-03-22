<?php

namespace App\User\adapter\in\web\response;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveResponse extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'result' => 'ok'
        ];
    }
}
