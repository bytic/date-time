<?php

namespace ByTIC\DateTime\Tests\Duration;

use ByTIC\DateTime\Duration;
use ByTIC\DateTime\Tests\AbstractTest;

/**
 * Class CheckDurationTest
 * @package ByTIC\DateTime\Tests\Duration
 */
class CheckDurationTest extends AbstractTest
{
    public function test_isZero()
    {
        self::assertFalse(Duration::createFromSeconds(1)->isZero());
        self::assertFalse(Duration::createFromSeconds(0.1)->isZero());
        self::assertTrue(Duration::createFromSeconds(0)->isZero());
    }
}