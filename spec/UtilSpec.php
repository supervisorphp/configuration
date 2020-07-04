<?php

namespace spec\Supervisor\Configuration;

use PhpSpec\ObjectBehavior;
use Supervisor\Configuration\Util;

class UtilSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Util::class);
    }

    function it_tests_a_byte_integer_representation()
    {
        $this->isByte(1024)->shouldReturn(true);
    }

    function it_tests_a_byte_string_representation()
    {
        $this->isByte('10KB')->shouldReturn(true);
        $this->isByte('10kB')->shouldReturn(true);
        $this->isByte('10Kb')->shouldReturn(true);
        $this->isByte('10kb')->shouldReturn(true);
        $this->isByte('10 KB')->shouldReturn(false);
        $this->isByte('10 kilobytes')->shouldReturn(false);
        $this->isByte('ten kilobytes')->shouldReturn(false);
    }
}
