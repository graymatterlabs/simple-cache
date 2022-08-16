<?php

declare(strict_types=1);

namespace GrayMatterLabs\SimpleCache\Tests;

use GrayMatterLabs\SimpleCache\CookieCache;
use Psr\SimpleCache\CacheInterface;

/** @runTestsInSeparateProcesses enabled */
class CookieCacheTest extends BaseCacheTests
{
    public function getCache(): CacheInterface
    {
        return new CookieCache('test');
    }
}
