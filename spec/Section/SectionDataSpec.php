<?php

namespace spec\Supervisor\Configuration\Section;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SectionDataSpec extends ObjectBehavior
{
    use SectionBehavior;

    function let()
    {
        $this->beAnInstanceOf(
            'Supervisor\Configuration\Section\GenericSection',
            [
                'section',
                [
                    'key' => 'value',
                ],
            ]
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Configuration\Section\GenericSection');
    }

    function it_has_a_name()
    {
        $this->getName()->shouldReturn('section');
    }

    function it_returns_a_property()
    {
        $this->getProperty('key')->shouldReturn('value');
    }

    function it_returns_a_non_existent_property()
    {
        $this->getProperty('non_existent_key')->shouldReturn(null);
    }

    function it_accepts_a_property()
    {
        $this->setProperty('key', 'value2');

        $this->getProperty('key')->shouldReturn('value2');
    }

    function it_returns_properties()
    {
        $this->getProperties()->shouldReturn(['key' => 'value']);
    }

    function it_accepts_properties()
    {
        $this->setProperties(['key' => 'value2']);

        $this->getProperty('key')->shouldReturn('value2');
    }
}
