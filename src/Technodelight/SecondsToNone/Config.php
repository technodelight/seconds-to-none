<?php

namespace Technodelight\SecondsToNone;

use \ArrayAccess;
use \IteratorAggregate;
use \ArrayIterator;

class Config implements ArrayAccess, IteratorAggregate
{
    const PATTERN = '%d %s';
    private $map = [
        'days' => 86400,
        'day' => 86400,
        'hours' => 3600,
        'hour' => 3600,
        'minutes' => 60,
        'minute' => 60,
        'seconds' => 1,
        'second' => 1,
        'none' => 0,
    ];
    /**
     * @var string
     */
    private $pattern;

    /**
     * @param array $map
     * @param string $pattern
     */
    public function __construct(array $map = [], $pattern = self::PATTERN)
    {
        if (!empty($map)) {
            $this->map = $map;
        }
        $this->pattern = $pattern;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->map);
    }

    public function offsetExists($offset)
    {
        return !empty($this->map[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->map[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        // nope
    }

    public function offsetUnset($offset)
    {
        // nada
    }

    public function pattern()
    {
        return $this->pattern;
    }

    public function text($text)
    {
        return isset($this->map[$text]) ? $this->map[$text] : null;
    }

    /**
     * @param integer $number
     */
    public function number($number)
    {
        $index = array_search($number, $this->map);
        return $index !== false ? $index : null;
    }

    public function texts()
    {
        return array_keys($this->map);
    }

    public function numbers()
    {
        return array_values($this->map);
    }
}
