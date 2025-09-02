<?php

declare(strict_types=1);

namespace App\Services\Common;

use App\Repositories\Common\UserRepository;
use App\Services\BaseService;

final class UserService extends BaseService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly PhoneService $phoneService,
    ) {
        parent::__construct();
    }

    public function login(int $phone): void
    {
        $user = $this
            ->userRepository
            ->firstOrCreate(compact('phone'));
        $code = random_int(1000, 9999);

        // save code to cache
        $cacheKey = $this->getCodeCacheKeyByUserId($user->id);
        $this->cacheHelper->set($cacheKey, $code, 600);

        // send code to phone
        $this->phoneService->sendMessage($phone, 'The code is ' . $code);
    }

    private function getCodeCacheKeyByUserId(int $userId): string
    {
        return sprintf('user.%s.code', $userId);
    }

    public function createToken(int $phone, int $code, string $deviceName): ?string
    {
        $user = $this
            ->userRepository
            ->firstWhereOrFail([
                'phone' => $phone,
            ]);

        $cacheKey = $this->getCodeCacheKeyByUserId($user->getKey());
        $cacheCode = $this->cacheHelper->get($cacheKey);

        if (empty($cacheCode) || $cacheCode !== $code) {
            return null;
        }

        $this->cacheHelper->delete($cacheKey);

        return $user->createToken($deviceName)->plainTextToken;
    }

    public function deleteToken(): void
    {
        $this->getUser()->currentAccessToken()->delete();
    }

    public function deleteAllTokens(): void
    {
        $this->getUser()->tokens()->delete();
    }
}
