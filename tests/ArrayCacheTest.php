<?php

declare(strict_types=1);

namespace GrayMatterLabs\SimpleCache\Tests;

use GrayMatterLabs\SimpleCache\ArrayCache;
use Psr\SimpleCache\CacheInterface;

class ArrayCacheTest extends BaseCacheTests
{
    public function getCache(): CacheInterface
    {
        return new ArrayCache();
    }
}
