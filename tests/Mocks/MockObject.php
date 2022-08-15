<?php

declare(strict_types=1);

namespace GrayMatterLabs\SimpleCache\Tests\Mocks;

class MockObject
{
    public function __construct(public mixed $value = null)
    {
    }
}
