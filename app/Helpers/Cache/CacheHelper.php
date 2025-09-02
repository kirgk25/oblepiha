<?php

declare(strict_types=1);

namespace App\Helpers\Cache;

use Illuminate\Cache\CacheManager;

final class CacheHelper
{
    private const DEFAULT_TTL = 600;

    private CacheManager $cache;

    public function __construct()
    {
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
        return md5(json_encode(request()->all()));
    }
}
