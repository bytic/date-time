<?php

declare(strict_types=1);

namespace ByTIC\DateTime\Duration;

use ByTIC\DateTime\Duration;

/**
 * Trait CompareDurations
 * @package ByTIC\DateTime\Duration
 */
trait CompareDurations
{
    /**
     * Compares this Duration to the specified duration.
     *
     * @param Duration $that The other duration to compare to.
     *
     * @return int [-1,0,1] If this duration is less than, equal to, or greater than the given duration.
     */
    public function compareTo($other) : int
    {
        $other = $other instanceof self ? $other : self::create($other);

        $now = self::now();
        $here = $now->add($this);
        $there = $now->add($other);

        return $here <=> $there;
    }

    /**
     * Checks if this Duration is equal to the specified duration.
     */
    public function isEqualTo(Duration $that) : bool
    {
        return 0 === $this->compareTo($that);
    }

    /**
     * Checks if this Duration is greater than the specified duration.
     */
    public function isGreaterThan(Duration $that) : bool
    {
        return $this->compareTo($that) > 0;
    }

    /**
     * Checks if this Duration is less than the specified duration.
     */
    public function isLessThan(Duration $that) : bool
    {
        return -1 === $this->compareTo($that);
    }
}