<?php namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Cache\CacheManager;

class CacheService
{
    private const DEFAULT_TTL = 600;

    private Request $request;
    private CacheManager $cache;

    public function __construct()
    {
        $this->request = request();
        $this->cache = cache();
    }

    public function get(string $key): mixed
    {
        return $this->cache->get($key);
    }

    public function has(string $key): bool
    {
        return $this->cache->has($key);
    }

    public function pull(string $key): mixed
    {
        return $this->cache->pull($key);
    }

    public function set(string $key, mixed $value, int $ttl = self::DEFAULT_TTL): mixed
    {
        return $this->cache->put($key, $value, $ttl);
    }

    public function delete(string $key): mixed
    {
        return $this->cache->forget($key);
    }

    public function getRequestKey(): string
    {
        return md5(json_encode($this->request->all()));
    }
}
