<?php

namespace ByTIC\DateTime\Tests\Duration;

use ByTIC\DateTime\Duration;
use ByTIC\DateTime\DurationInterface;
use ByTIC\DateTime\Tests\AbstractTest;

/**
 * Class ValuesOfDurationTest
 * @package ByTIC\DateTime\Tests\Duration
 */
class ValuesOfDurationTest extends AbstractTest
{
    public function test_inSeconds()
    {
        self::assertSame(DurationInterface::SECONDS_IN_DAY * 2, Duration::ofDays(2)->inSeconds());
    }

    public function test_inMinutes()
    {
        self::assertEquals(75, Duration::ofMinutes(75)->inMinutes());
    }
}