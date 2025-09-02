<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Helpers\Cache\CacheHelper;

class BaseService
{
    protected CacheHelper $cacheHelper;

    public function __construct()
    {
        $this->cacheHelper = app()->make(CacheHelper::class);
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
