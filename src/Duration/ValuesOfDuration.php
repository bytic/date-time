<?php

declare(strict_types=1);

namespace ByTIC\DateTime\Duration;

use ByTIC\DateTime\DurationInterface;

/**
 * Trait ValuesOfDuration
 * @package ByTIC\DateTime\Duration
 */
trait ValuesOfDuration
{
    public function inSeconds(): int
    {
        return $this->s
            + ($this->i * self::SECONDS_IN_MINUTE)
            + ($this->h * self::SECONDS_IN_HOUR)
            + ($this->d * self::SECONDS_IN_DAY)
            + ($this->m * self::SECONDS_IN_MONTH)
            + ($this->y * self::SECONDS_IN_YEAR);
    }

    public function inMinutes(): float
    {
        return $this->inSeconds() / DurationInterface::SECONDS_IN_MINUTE;
    }

    public function inHours(): float
    {
        return $this->inSeconds() / DurationInterface::SECONDS_IN_HOUR;
    }

    public function inDays(): float
    {
        return $this->inSeconds() / DurationInterface::SECONDS_IN_DAY;
    }

    public function inWeeks(): float
    {
        return $this->inSeconds() / DurationInterface::SECONDS_IN_WEEK;
    }
}
