<?php

declare(strict_types=1);

namespace ByTIC\DateTime\Duration;

use ByTIC\DateTime\Duration\Formatter\DateIntervalSpecFormatter;
use ByTIC\DateTime\Duration\Formatter\DurationFormatter;
use ByTIC\DateTime\Duration\Formatter\FormatterFactory;

/**
 * Trait FormatDurations
 * @package ByTIC\DateTime\Duration
 */
trait FormatDurations
{

    /**
     * Serializes as a string using {@see Duration::__toString()}.
     */
    public function jsonSerialize(): string
    {
        return (string)$this;
    }

    public function __toString(): string
    {
        return $this->formatUsing(DateIntervalSpecFormatter::class);
    }

    /**
     * @param DurationFormatter|string $formatter
     * @return string
     */
    public function formatUsing($formatter)
    {
        return FormatterFactory::create($formatter)->format($this);
    }
}