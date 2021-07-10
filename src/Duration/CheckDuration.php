<?php

declare(strict_types=1);

namespace ByTIC\DateTime\Duration;

/**
 * Trait CheckDuration
 * @package ByTIC\DateTime\Duration
 */
trait CheckDuration
{
    /**
     * Returns whether this Duration is zero length.
     */
    public function isZero(): bool
    {
        $properties = ['y', 'm', 'd', 'h', 'i', 's', 'f'];
        foreach ($properties as $property) {
            if ($this->{$property} != 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Returns whether this Duration is positive, excluding zero.
     */
    public function isPositive(): bool
    {
        return $this->invert == 0;
    }

    /**
     * Returns whether this Duration is positive or zero.
     */
    public function isPositiveOrZero(): bool
    {
        return $this->isNegative() == false;
    }

    /**
     * Returns whether this Duration is negative, excluding zero.
     */
    public function isNegative(): bool
    {
        return $this->invert == 1;
    }

    /**
     * @param mixed $other An interval/duration
     */
    public function isLargerThan($other): bool
    {
        return 1 === $this->compareTo($other);
    }

    /**
     * @param mixed $other An interval/duration
     */
    public function equals($other): bool
    {
        return 0 === $this->compareTo($other);
    }

    /**
     * @param mixed $other An interval/duration
     */
    public function isSmallerThan($other): bool
    {
        return -1 === $this->compareTo($other);
    }

    /**
     * @param mixed $other An interval/duration
     */
    public function diff($other): self
    {
        $other = $other instanceof self ? $other : self::make($other);

        $now = self::now();
        $here = $now->add($this);
        $there = $now->add($other);

        return self::make($here->diff($there, true));
    }
}