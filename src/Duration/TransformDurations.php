<?php

declare(strict_types=1);

namespace ByTIC\DateTime\Duration;

use ByTIC\DateTime\Duration;
use ByTIC\DateTime\Duration\Exception\InvalidDuration;

/**
 * Trait TransformDurations
 * @package ByTIC\DateTime\Duration
 */
trait TransformDurations
{

    /**
     * Returns a copy of this Duration with the specified duration added.
     */
    public function plus($duration): Duration
    {
        $duration = $duration instanceof self ? $duration : self::create($duration);

        $now = self::now();
        $then = $now->add($this)->add($duration);

        return self::create($then->diff($now, true));
    }

    /**
     * @param mixed $other An interval/duration
     */
    public function minus($duration): self
    {
        $duration = $duration instanceof self ? $duration : self::create($duration);

        $now = self::now();
        $then = $now->add($this)->sub($duration);

        if ($then < $now) {
            throw InvalidDuration::because('A duration cannot be smaller than zero');
        }

        return self::create($then->diff($now, true));
    }
}