<?php

namespace Technodelight\SecondsToNone;

use \ArrayAccess;

class Config implements ArrayAccess
{
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

    public function __construct(array $map = [])
    {
        $this->map = $map;
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

    public function text($text)
    {
        return isset($this->map[$text]) ? $this->map[$text] : null;
    }

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
