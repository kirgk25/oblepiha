<?php namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class BaseService
{
    protected Request $request;
    protected CacheService $cacheService;

    public function __construct()
    {
        $this->request = request();
        $this->cacheService = new CacheService();
    }

    public function user(): User
    {
        return auth()->user();
    }
}
