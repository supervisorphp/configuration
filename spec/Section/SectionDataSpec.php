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

    function it_has_a_property()
    {
        $this->hasProperty('key')->shouldReturn(true);
        $this->getProperty('key')->shouldReturn('value');

        $this->hasProperty('key2')->shouldReturn(false);

        $this->setProperty('key2', 'value2');

        $this->hasProperty('key2')->shouldReturn(true);
        $this->getProperty('key2')->shouldReturn('value2');
    }

    function it_has_properties()
    {
        $this->setProperties([
            'key2' => 'value2',
        ]);

        $this->getProperties()->shouldReturn([
            'key2' => 'value2',
        ]);
    }
}
