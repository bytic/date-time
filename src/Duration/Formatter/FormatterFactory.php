<?php

declare(strict_types=1);

namespace ByTIC\DateTime\Duration\Formatter;

/**
 * Class FormatterFactory
 * @package ByTIC\DateTime\Duration\Formatter
 */
class FormatterFactory
{
    public static function create($formatter): DurationFormatter
    {
        if (is_object($formatter)) {
            return static::createFromObject($formatter);
        }

        if (is_string($formatter)) {
            if (class_exists($formatter)) {
                $formatter = static::createFromObject(new  $formatter());
                return $formatter;
            }
        }
        throw new \Exception("Invalid formatter");
    }

    protected static function createFromObject($formatter)
    {
        if ($formatter instanceof DurationFormatter) {
            return $formatter;
        }
        throw new \Exception("Invalid formatter");
    }
}