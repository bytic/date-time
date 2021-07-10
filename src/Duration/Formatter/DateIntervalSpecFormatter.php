<?php

declare(strict_types=1);

namespace ByTIC\DateTime\Duration\Formatter;

use ByTIC\DateTime\Duration;
use DateInterval;

/**
 * Class DateIntervalSpecFormatter
 * @package ByTIC\DateTime\Duration\Formatter
 */
class DateIntervalSpecFormatter implements DurationFormatter
{
    private const NONE = 'PT0S';

    public function format(Duration $duration): string
    {
        $spec = 'P';
        $spec .= 0 !== $duration->y ? $duration->y.'Y' : '';
        $spec .= 0 !== $duration->m ? $duration->m.'M' : '';
        $spec .= 0 !== $duration->d ? $duration->d.'D' : '';

        $spec .= 'T';
        $spec .= 0 !== $duration->h ? $duration->h.'H' : '';
        $spec .= 0 !== $duration->i ? $duration->i.'M' : '';
        $spec .= 0 !== $duration->s ? $duration->s.'S' : '';

        if ('T' === substr($spec, -1)) {
            $spec = substr($spec, 0, -1);
        }

        if ('P' === $spec) {
            return self::NONE;
        }

        return $spec;
    }
}