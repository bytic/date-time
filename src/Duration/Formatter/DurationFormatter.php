<?php

declare(strict_types=1);

namespace ByTIC\DateTime\Duration\Formatter;

use ByTIC\DateTime\Duration;

/**
 * Interface DurationFormatter
 * @package ByTIC\DateTime\Duration\Formatter
 */
interface DurationFormatter
{

    /**
     * Formats a Duration object as string.
     *
     * Exception\FormatterException
     */
    public function format(Duration $duration): string;
}
