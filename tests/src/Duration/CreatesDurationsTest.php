<?php

namespace ByTIC\DateTime\Tests\Duration;

use ByTIC\DateTime\Duration;
use ByTIC\DateTime\Tests\AbstractTest;

/**
 * Class CreatesDurationsTest
 * @package ByTIC\DateTime\Tests\Duration
 */
class CreatesDurationsTest extends AbstractTest
{
    /**
     * @param $seconds
     * @param $expected
     *
     * @dataProvider data_createFromSeconds
     */
    public function test_createFromSeconds($seconds, $expected)
    {
        $duration = Duration::createFromSeconds($seconds);
        self::assertSame($expected, (string)$duration);
    }

    public function data_createFromSeconds(): iterable
    {
        return [
            [0, 'PT0S'],
            [1, 'PT1S'],
            [19999, 'PT5H33M19S'],
        ];
    }

    public function test_ofSeconds()
    {
        self::assertSame('PT50S', (string)Duration::ofSeconds(50));
        self::assertSame('PT1M', (string)Duration::ofSeconds(60));
        self::assertSame('PT2M', (string)Duration::ofSeconds(120));
    }

    public function test_ofWeeks()
    {
        self::assertSame('PT168H', (string)Duration::ofWeeks(1));
    }
}
