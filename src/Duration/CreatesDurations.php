<?php

declare(strict_types=1);

namespace ByTIC\DateTime\Duration;

use ByTIC\DateTime\Duration;
use ByTIC\DateTime\Duration\Exception\InvalidDuration;
use DateInterval;
use DateTimeImmutable;

/**
 * Trait CreatesDurations
 * @package ByTIC\DateTime\Duration
 */
trait CreatesDurations
{

    /**
     * @param mixed $duration An interval/duration
     *
     * @throws InvalidDuration if the specification cannot be parsed
     */
    public static function create($duration): self
    {
        if ($duration instanceof DateInterval) {
            return self::createFromDateInterval($duration);
        }

        if (in_array($duration, [0, null, false, true], true)) {
            return self::none();
        }

        $seconds = filter_var($duration, FILTER_VALIDATE_FLOAT);
        if (false !== $seconds) {
            return self::createFromSeconds($seconds);
        }


        if (!is_string($duration) && !method_exists($duration, '__toString')) {
            throw InvalidDuration::because(
                sprintf('%s expects parameter 1 to be string, %s given', __METHOD__, gettype($duration))
            );
        }

        $duration = (string)$duration;

        if ('' === $duration) {
            return self::none();
        }

        if (1 === preg_match(self::REGEXP_CHRONO_FORMAT, $duration)) {
            return self::createFromChronoString($duration);
        }


        throw InvalidDuration::because(sprintf('Unknown or bad format (%s)', $duration));
    }

    public static function createFromDateInterval(DateInterval $duration): self
    {
        $new = new self('PT0S');
        foreach ($duration as $name => $value) {
            if (property_exists($new, $name)) {
                $new->{$name} = $value;
            }
        }

        return $new;
    }

    /**
     * Creates a new instance from a seconds.
     *
     * the second value will be overflow up to the hour time unit.
     */
    public static function createFromSeconds(float $seconds): self
    {
        $invert = 0 > $seconds;
        if ($invert) {
            $seconds = $seconds * -1;
        }

        $secondsInt = (int)$seconds;
        $fraction = (int)(($seconds - $secondsInt) * 1e6);
        $minute = intdiv($secondsInt, 60);
        $secondsInt = $secondsInt - ($minute * 60);
        $hour = intdiv($minute, 60);
        $minute = $minute - ($hour * 60);

        return self::createFromTimeUnits(
            [
                'hour' => (string)$hour,
                'minute' => (string)$minute,
                'second' => (string)$secondsInt,
                'fraction' => (string)$fraction,
                'sign' => $invert ? '-' : '+',
            ]
        );
    }

    /**
     * Creates a new instance from a timer string representation.
     *
     * @throws InvalidDuration
     */
    public static function createFromChronoString(string $duration): self
    {
        if (1 !== preg_match(self::REGEXP_CHRONO_FORMAT, $duration, $units)) {
            throw InvalidDuration::because(sprintf('Unknown or bad format (%s)', $duration));
        }

        if ('' === $units['hour']) {
            $units['hour'] = '0';
        }

        return self::createFromTimeUnits($units);
    }

    /**
     * Creates a new instance from a time string representation following RDBMS specification.
     *
     * @throws InvalidDuration
     */
    public static function createFromTimeString(string $duration): self
    {
        if (1 !== preg_match(self::REGEXP_TIME_FORMAT, $duration, $units)) {
            throw InvalidDuration::because(sprintf('Unknown or bad format (%s)', $duration));
        }

        return self::createFromTimeUnits($units);
    }

    /**
     * Creates an instance from DateInterval units.
     *
     * @param array<string,string> $units
     */
    private static function createFromTimeUnits(array $units): self
    {
        $units = $units + ['hour' => '0', 'minute' => '0', 'second' => '0', 'fraction' => '0', 'sign' => '+'];

        $units['fraction'] = str_pad($units['fraction'] ?? '000000', 6, '0');

        $expression = $units['hour'] . ' hours '
            . $units['minute'] . ' minutes '
            . $units['second'] . ' seconds '
            . $units['fraction'] . ' microseconds';

        /** @var Duration $instance */
        $instance = self::createFromDateString($expression);
        if ('-' === $units['sign']) {
            $instance->invert = 1;
        }

        return $instance;
    }

    /**
     * @inheritDoc
     *
     * @param mixed $duration a date with relative parts
     *
     * @return self|false
     */
    public static function createFromDateString($duration)
    {
        $duration = parent::createFromDateString($duration);
        if (false === $duration) {
            return false;
        }

        $new = new self('PT0S');
        foreach ($duration as $name => $value) {
            $new->$name = $value;
        }

        return $new;
    }

    private static function now(): DateTimeImmutable
    {
        static $now;

        /* @noinspection PhpUnhandledExceptionInspection */
        return $now = $now ?? new DateTimeImmutable('@' . time());
    }

    public static function none(): self
    {
        return new self(self::NONE);
    }

    /**
     * Returns a zero length Duration.
     */
    public static function zero(): self
    {
        return self::createFromSeconds(0);
    }
}