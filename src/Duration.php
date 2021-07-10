<?php

declare(strict_types=1);

namespace ByTIC\DateTime;

use ByTIC\DateTime\Duration\Exception\InvalidDuration;
use DateInterval;
use Throwable;

/**
 * Class Duration
 * @package ByTIC\DateTime
 */
class Duration extends DateInterval implements \JsonSerializable
{
    use Duration\CheckDuration;
    use Duration\CreatesDurations;
    use Duration\FormatDurations;
    use Duration\TransformDurations;
    use Duration\ValuesOfDuration;

    private const REGEXP_CHRONO_FORMAT = '@^
        (?<sign>\+|-)?                  # optional sign
        ((?<hour>\d+):)?                # optional hour
        ((?<minute>\d+):)(?<second>\d+) # required minute and second
        (\.(?<fraction>\d{1,6}))?       # optional fraction
    $@x';

    /**
     * @param string $spec An interval/duration specification
     *
     * @throws InvalidDuration if the specification cannot be parsed
     */
    public function __construct(string $spec)
    {
        try {
            parent::__construct($spec);
        } catch (Throwable $e) {
            throw InvalidDuration::because($e->getMessage(), $e->getCode());
        }
    }

}