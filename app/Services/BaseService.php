<?php namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class BaseService
{
    protected Request $request;
    protected CacheService $cacheService;
    protected MessageBrokerService $messageBrokerService;

    public function __construct()
    {
        $this->request = request();
        $this->cacheService = new CacheService();
        $this->messageBrokerService = new MessageBrokerService();
    }

    public function getUser(): User
    {
        return auth()->user();
    }

    public function getUserId(): int
    {
        return auth()->user()->id;
    }
}
