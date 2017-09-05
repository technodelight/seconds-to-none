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
            $seconds -= ($value * $amount);
            if ($value >= 1) {
                $human[] = sprintf($this->config->pattern(), $value, $stringRepresentation);
            }
        }
        return implode(' ', $human);
    }

    public function humanToSeconds($def)
    {
        if ($def == $this->config->number(0)) {
            return 0;
        }

        $buffer = '';
        $seconds = 0;
        for ($pos = 0; $pos < strlen($def); $pos++) {
            $char = substr($def, $pos, 1);
            $nextChar = substr($def, $pos + 1, 1);
            $buffer.= $char;

            list($number, $unit) = sscanf($buffer, $this->config->pattern());

            if (!is_null($number) && isset($this->config[$unit]) && (empty($nextChar) || $nextChar == ' ')) {
                $seconds += $number * $this->config[$unit];
                $buffer = '';
            }
        }
        return $seconds;
    }
}
