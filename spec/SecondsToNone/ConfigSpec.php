<?php

namespace spec\Technodelight\SecondsToNone;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['hour' => 3600, 'none' => 0]);
    }

    function it_accepts_a_map_of_settings()
    {
        $this['hour']->shouldReturn(3600);
    }

    function it_returns_numbers_text_representation()
    {
        $this->text('none')->shouldReturn(0);
    }

    function it_returns_text_for_a_number()
    {
        $this->number(3600)->shouldReturn('hour');
        $this->number(0)->shouldReturn('none');
    }

    function it_returns_texts_and_numbers()
    {
        $this->texts()->shouldReturn(['hour', 'none']);
        $this->numbers()->shouldReturn([3600, 0]);
    }
}
