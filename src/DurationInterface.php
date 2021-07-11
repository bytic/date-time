<?php

declare(strict_types=1);

namespace ByTIC\DateTime;

/**
 * Interface DurationInterface
 * @package ByTIC\DateTime
 */
interface DurationInterface
{
    const SECONDS_IN_MINUTE = 60;
    const SECONDS_IN_HOUR = 60 * self::SECONDS_IN_MINUTE;
    const SECONDS_IN_DAY = 24 * self::SECONDS_IN_HOUR;
    const SECONDS_IN_WEEK = 7 * self::SECONDS_IN_DAY;

    const SECONDS_IN_MONTH = 30 * self::SECONDS_IN_DAY;
    const SECONDS_IN_YEAR = 365 * self::SECONDS_IN_MONTH;
}