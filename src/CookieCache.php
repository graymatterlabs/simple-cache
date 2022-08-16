<?php

declare(strict_types=1);

namespace GrayMatterLabs\SimpleCache;

class CookieCache extends ArrayCache
{
    public function __construct(protected string $cookie)
    {
        $this->cache = @json_decode($_COOKIE[$this->cookie] ?? '[]', true) ?? [];
    }

    public function __destruct()
    {
        setcookie($this->cookie, json_encode($this->cache), strtotime('+1 year'), '/');
    }
}
