<?php namespace App\Services;

use App\Models\User;

class BaseService
{
    protected CacheService $cacheService;
    protected MessageBrokerService $messageBrokerService;

    public function __construct()
    {
        $this->cacheService = app()->make(CacheService::class);
        $this->messageBrokerService = app()->make(MessageBrokerService::class);
    }

    public function getUser(): User
    {
        return auth()->user();
    }

    public function getUserId(): int
    {
        return auth()
            ->user()
            ->getKey();
    }
}
