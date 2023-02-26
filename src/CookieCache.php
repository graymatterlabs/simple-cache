<?php

declare(strict_types=1);

namespace GrayMatterLabs\SimpleCache;

use DateInterval;

class CookieCache extends ArrayCache
{
    public function __construct(protected string $cookie)
    {
        $this->cache = json_decode($_COOKIE[$this->cookie] ?? '[]', true) ?: [];
    }

    public function delete(string $key): bool
    {
        $response = parent::delete($key);

        $this->updateCookieValue();

        return $response;
    }

    public function clear(): bool
    {
        $response = parent::clear();

        $this->updateCookieValue();

        return $response;
    }

    public function set(string $key, mixed $value, DateInterval|int|null $ttl = null): bool
    {
        $response = parent::set($key, $value, $ttl);

        $this->updateCookieValue();

        return $response;
    }

    protected function updateCookieValue(): void
    {
        setcookie($this->cookie, json_encode($this->cache), strtotime('+1 year'), '/');
    }
}
