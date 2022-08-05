<?php
namespace App\Http\Responses;
use Laravel\Fortify\Contracts\RegisterResponse as ContractsLoginResponse;
class RegisterResponse implements ContractsLoginResponse
{
    public function toResponse($request)
    {
        return redirect()->intended(config('fortify.home'));
    }
}