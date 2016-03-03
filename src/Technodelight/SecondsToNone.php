<?php

namespace Technodelight;

class SecondsToNone
{
    const ZERO_SECONDS = 'none';

    private $secondsMap = [
        'days' => 27000, // 7h 30m
        'day' => 27000, // 7h 30m
        'hours' => 3600,
        'hour' => 3600,
        'minutes' => 60,
        'minute' => 60,
        'seconds' => 1,
        'second' => 1,
    ];

    public function secondsToHuman($seconds)
    {
        if ($seconds === 0) {
            return self::ZERO_SECONDS;
        }

        $human = [];
        foreach ($this->secondsMap as $stringRepresentation => $amount) {
            if ($seconds < 1) {
                break;
            }
            $value = floor($seconds / $amount);
            $seconds-= ($value * $amount);
            if ($value >= 1) {
                $human[] = sprintf('%d %s', $value, $stringRepresentation);
            }
        }
        return implode(' ', $human);
    }

    public function humanToSeconds($def)
    {
        if ($def == self::ZERO_SECONDS) {
            return 0;
        }
        foreach (array_keys($this->secondsMap) as $unit) {
            $def = preg_replace('~[ ]+'.preg_quote($unit).'~', $unit, $def);
        }

        $parts = explode(' ', $def);
        $seconds = 0;
        foreach ($parts as $part) {
            if (preg_match('~([0-9]+)([a-z]+)~', trim($part), $matches)) {
                list(,$number,$unit) = $matches;
                $seconds+= isset($this->secondsMap[$unit]) ? ($number * $this->secondsMap[$unit]) : 0;
            }
        }
        return $seconds;
    }
}
