<?php

namespace spec\Indigo\Supervisor\Stub;

use PhpSpec\ObjectBehavior;

class SectionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['key' => 'value']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Supervisor\Stub\Section');
        $this->shouldHaveType('Indigo\Supervisor\Configuration\Section\Base');
    }

    function it_is_a_section()
    {
        $this->shouldImplement('Indigo\Supervisor\Configuration\Section');
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

    function it_accepts_and_normalizes_an_environmment_property()
    {
        $this->setProperty('environment', [
            'key1' => 'val1',
            'key2' => 'val2',
            'val3', // this should be ommitted
        ]);

        $this->getProperty('environment')->shouldReturn('KEY1="val1",KEY2="val2"');
    }
}
