<?php

declare(strict_types=1);

namespace ByTIC\DateTime\Duration\Exception;

use InvalidArgumentException;
use Throwable;

/**
 * Class InvalidDuration
 * @package ByTIC\DateTime\Duration\Exception
 */
final class InvalidDuration extends InvalidArgumentException implements DurationException
{
    public static function because(string $reason, int $code = null, Throwable $previous = null): self
    {
        return new self($reason, $code ?: 0, $previous);
    }
}
