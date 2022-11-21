<?php

declare(strict_types=1);

namespace Technodelight\SecondsToNone;

use \ArrayAccess;
use \IteratorAggregate;
use \ArrayIterator;

class Config implements ArrayAccess, IteratorAggregate
{
    public const PATTERN = '%d %s';
    private array $map = [
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
    private string $pattern;

    public function __construct(array $map = [], string $pattern = self::PATTERN)
    {
        if (!empty($map)) {
            $this->map = $map;
        }
        $this->pattern = $pattern;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->map);
    }

    public function offsetExists($offset): bool
    {
        return !empty($this->map[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->offsetExists($offset) ? $this->map[$offset] : null;
    }

    public function offsetSet($offset, $value): void
    {
        // nope
    }

    public function offsetUnset($offset): void
    {
        // nada
    }

    public function pattern(): string
    {
        return $this->pattern;
    }

    public function text($text): ?int
    {
        return $this->map[$text] ?? null;
    }

    public function number(int $number): string|null
    {
        $index = array_search($number, $this->map, true);
        return $index !== false ? $index : null;
    }

    public function texts(): array
    {
        return array_keys($this->map);
    }

    public function numbers(): array
    {
        return array_values($this->map);
    }
}
