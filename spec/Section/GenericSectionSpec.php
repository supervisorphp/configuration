<?php

namespace spec\Supervisor\Configuration\Section;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GenericSectionSpec extends ObjectBehavior
{
    use SectionBehavior;

    function let()
    {
        $this->beConstructedWith('section', [
            'key' => 'value',
        ]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Configuration\Section\GenericSection');
    }
}
