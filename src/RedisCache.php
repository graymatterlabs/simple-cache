<?php

declare(strict_types=1);

namespace GrayMatterLabs\SimpleCache;

use DateInterval;
use DateTime;
use Psr\SimpleCache\CacheInterface;
use Redis;

class RedisCache implements CacheInterface
{
    public function __construct(private Redis $redis)
    {
    }

    public function get(string $key, mixed $default = null): mixed
    {
        $value = $this->redis->get($key);

        if ($value === false) {
            return $default;
        }

        return $value;
    }

    public function set(string $key, mixed $value, DateInterval|int|null $ttl = null): bool
    {
        if ($ttl instanceof DateInterval) {
            $ttl = (new DateTime())->add($ttl)->getTimestamp();
        }

        return (bool) $this->redis->set($key, $value, $ttl);
    }

    public function delete(string $key): bool
    {
        return (bool) $this->redis->del($key);
    }

    public function clear(): bool
    {
        return (bool) $this->redis->flushAll();
    }

    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        return array_map(function ($value) use ($default) {
            return $value === false ? $default : $value;
        }, (array) $this->redis->mGet($keys));
    }

    public function setMultiple(iterable $values, DateInterval|int|null $ttl = null): bool
    {
        $return = true;

        foreach ($values as $key => $value) {
            if (! $this->redis->set($key, $value, $ttl)) {
                $return = false;
            }
        }

        return $return;
    }

    public function deleteMultiple(iterable $keys): bool
    {
        return $this->redis->del($keys);
    }

    public function has(string $key): bool
    {
        return $this->redis->exists($key);
    }
}
