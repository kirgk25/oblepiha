<?php namespace App\Services;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService extends BaseService
{
    private PhoneService $phoneService;

    public function __construct(PhoneService $phoneService)
    {
        parent::__construct();
        $this->phoneService = $phoneService;
    }

    public function login(int $phone): void
    {
        $user = User::firstOrCreate(compact('phone'));
        $code = random_int(1000, 9999);

        // save code to cache
        $cacheKey = $this->getCodeCacheKeyByUserId($user->id);
        $this->cacheService->set($cacheKey, $code, 600);

        // send code to phone
        $this->phoneService->sendMessage($phone, 'The code is ' . $code);
    }

    private function getCodeCacheKeyByUserId(int $userId): string
    {
       return sprintf('user.%s.code', $userId);
    }

    public function createToken(int $phone, int $code, string $deviceName): ?string
    {
        $user = User::firstOrFail([
            'phone' => $phone
        ]);

        $cacheKey = $this->getCodeCacheKeyByUserId($user->getKey());
        $cacheCode = $this->cacheService->get($cacheKey);

        if (empty($cacheCode) || $cacheCode !== $code) {
            return null;
        }

        $this->cacheService->delete($cacheKey);

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
