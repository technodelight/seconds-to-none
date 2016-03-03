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
}
