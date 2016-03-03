<?php

namespace spec\Technodelight;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SecondsToNoneSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Technodelight\SecondsToNone');
    }
}
