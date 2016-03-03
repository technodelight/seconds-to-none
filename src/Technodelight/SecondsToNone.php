<?php

namespace Technodelight;

use Technodelight\SecondsToNone\Config;

class SecondsToNone
{
    private $config;

    public function __construct(Config $config = null)
    {
        $this->config = $config ?: new Config;
    }

    public function secondsToHuman($seconds)
    {
        $seconds = (int) $seconds;
        if ($seconds == 0) {
            return $this->config->number(0);
        }

        $human = [];
        foreach ($this->config as $stringRepresentation => $amount) {
            if ($seconds < 1 || $amount < 1) {
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
        if ($def == $this->config->number(0)) {
            return 0;
        }
        foreach ($this->config->texts() as $unit) {
            $def = preg_replace('~[ ]+'.preg_quote($unit).'~', $unit, $def);
        }

        $parts = explode(' ', $def);
        $seconds = 0;
        foreach ($parts as $part) {
            if (preg_match('~([0-9]+)([a-z]+)~', trim($part), $matches)) {
                list(,$number,$unit) = $matches;
                $seconds+= isset($this->config[$unit]) ? ($number * $this->config[$unit]) : 0;
            }
        }
        return $seconds;
    }
}
