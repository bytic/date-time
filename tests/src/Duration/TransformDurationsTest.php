<?php

namespace ByTIC\DateTime\Tests\Duration;

use ByTIC\DateTime\Duration;
use ByTIC\DateTime\Tests\AbstractTest;

/**
 * Class TransformDurationsTest
 * @package ByTIC\DateTime\Tests\Duration
 */
class TransformDurationsTest extends AbstractTest
{
    public function test_add()
    {
        $duration = Duration::createFromSeconds(10)
            ->plus(70);

        self::assertSame('PT1M20S', (string)$duration);
    }

    public function test_minus()
    {
        $duration = Duration::createFromSeconds(90)
            ->minus(60);

        self::assertSame('PT30S', (string)$duration);
    }
}