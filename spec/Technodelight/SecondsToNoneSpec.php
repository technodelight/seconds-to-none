<?php

namespace spec\Technodelight;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Technodelight\SecondsToNone\Config;

class SecondsToNoneSpec extends ObjectBehavior
{
    function it_converts_zero_to_none(Config $config)
    {
        $this->beConstructedWith($config);
        $config->number(0)->shouldBeCalled()->willReturn('none');
        $this->secondsToHuman(0)->shouldReturn('none');
    }

    function it_converts_none_to_zero(Config $config)
    {
        $this->beConstructedWith($config);
        $config->number(0)->shouldBeCalled()->willReturn('none');
        $this->humanToSeconds('none')->shouldReturn(0);
    }

    function it_returns_string_representation()
    {
        $this->secondsToHuman(12345)->shouldReturn('3 hours 25 minutes 45 seconds');
    }

    function it_returns_number_from_human_text()
    {
        $this->humanToSeconds('3 hours 25 minutes 45 seconds')->shouldReturn(12345);
    }

    function it_can_use_custom_pattern()
    {
        $config = new Config([], '%d%s');
        $this->beConstructedWith($config);
        $this->secondsToHuman(12345)->shouldReturn('3hours 25minutes 45seconds');
    }

    function it_can_use_a_reversed_pattern()
    {
        $config = new Config([], '%2$s %1$d');
        $this->beConstructedWith($config);
        $this->secondsToHuman(12345)->shouldReturn('hours 3 minutes 25 seconds 45');
    }
}
