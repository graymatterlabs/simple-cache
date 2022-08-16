<?php

declare(strict_types=1);

namespace GrayMatterLabs\SimpleCache\Tests;

use GrayMatterLabs\SimpleCache\Tests\Mocks\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\SimpleCache\CacheInterface;

abstract class BaseCacheTests extends TestCase
{
    /** @dataProvider providesKeysAndValues */
    public function test_it_sets_and_gets_values($key, $value, $array): void
    {
        $cache = $this->getCache();
        $this->assertTrue($cache->set($key, $value));
        $this->assertTrue($cache->setMultiple($array));

        $this->assertEquals($value, $cache->get($key));
        $key = array_keys($array)[0];
        $this->assertEquals($array[$key], $cache->get($key));
    }

    public function test_values_expire_after_ttl(): void
    {
        $cache = $this->getCache();
        $this->assertTrue($cache->set('foo', 'bar', -1));
        $this->assertNull($cache->get('foo'));
    }

    public function test_it_overwrites_values(): void
    {
        $cache = $this->getCache();
        $this->assertTrue($cache->set('foo', 'bar'));
        $this->assertTrue($cache->set('foo', 'baz'));
        $this->assertEquals('baz', $cache->get('foo'));
    }

    public function test_it_deletes_values(): void
    {
        $cache = $this->getCache();
        $this->assertTrue($cache->set('foo', 'bar'));
        $this->assertTrue($cache->delete('foo'));
        $this->assertNull($cache->get('foo'));
    }

    public function test_it_defaults_to_a_value(): void
    {
        $cache = $this->getCache();
        $this->assertEquals('bar', $cache->get('foo', 'bar'));
    }

    public function providesKeysAndValues(): array
    {
        return [
            'string' => ['string', 'value', ['string2' => 'value2']],
            'class' => ['class', new MockObject('a'), ['class2' => new MockObject('b')]],
            'array' => ['array', [], ['array2' => []]],
        ];
    }

    abstract public function getCache(): CacheInterface;

    protected function tearDown(): void
    {
        $this->getCache()->clear();
    }
}
