<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\StoreTokenRequest;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        public UserService $userService,
    ) {}

    public function login(LoginRequest $request)
    {
        $this->userService->login($request->phone);
    }

    public function token(StoreTokenRequest $request)
    {
        $token = $this->userService->createToken($request->phone, $request->code, $request->deviceName);
        if (!$token) {
            abort(HTTP_CODE_UNAUTHORIZED);
        }

        return response(compact('token'));
    }

    public function destroyToken()
    {
        $this->userService->deleteToken();
    }

    public function destroyTokens()
    {
        $this->userService->deleteAllTokens();
    }
}
