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
        $length = strlen($def);
        for ($pos = 0; $pos < $length; $pos++) {
            $char = substr($def, $pos, 1);
            $nextChar = substr($def, $pos + 1, 1);
            $buffer.= $char;

            list($number, $unit) = sscanf($buffer, $this->config->pattern());

            if ($this->isCurrentlyMatchingOnPattern($number, $unit, $nextChar)) {
                $seconds += $number * $this->config[$unit];
                $buffer = '';
            }
        }
        return $seconds;
    }

    /**
     * @param int|null $number
     * @param string $unit
     * @param string $nextChar
     * @return bool
     */
    private function isCurrentlyMatchingOnPattern($number, $unit, $nextChar)
    {
        return !is_null($number) && isset($this->config[$unit]) && (empty($nextChar) || $nextChar == ' ');
    }
}
