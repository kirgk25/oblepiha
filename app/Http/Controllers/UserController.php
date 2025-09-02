<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Users\LoginRequest;
use App\Http\Requests\Users\StoreTokenRequest;
use App\Http\Resources\Users\StoreTokenResource;
use App\Services\Common\UserService;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function __construct(
        public UserService $userService,
    ) {}

    public function login(LoginRequest $request): Response
    {
        $this->userService->login((int) $request->phone);
        return response()->noContent();
    }

    public function token(StoreTokenRequest $request): StoreTokenResource
    {
        $token = $this->userService->createToken((int) $request->phone, $request->code, $request->deviceName);
        if (null === $token) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        return StoreTokenResource::make($token);
    }

    public function destroyToken(): Response
    {
        $this->userService->deleteToken();
        return response()->noContent();
    }

    public function destroyTokens(): Response
    {
        $this->userService->deleteAllTokens();
        return response()->noContent();
    }
}
