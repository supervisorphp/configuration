<?php

namespace spec\Supervisor\Configuration\Stub;

use PhpSpec\ObjectBehavior;

class LoaderSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Configuration\Stub\Loader');
        $this->shouldHaveType('Supervisor\Configuration\Loader\Base');
    }

    function it_is_a_loader()
    {
        $this->shouldImplement('Supervisor\Configuration\Loader');
    }

    function it_accepts_a_section_to_the_map()
    {
        $this->addSectionMap('test', 'stdClass');

        $this->findSection('test')->shouldReturn('stdClass');
    }

    function it_throws_an_exception_when_section_not_found()
    {
        $this->findSection('invalid')->shouldReturn(false);
    }

    function it_parses_an_array()
    {
        $sections = $this->parseArray(['test' => ['key' => 'value']]);

        $sections->shouldBeArray();
        $sections[0]->shouldHaveType('Supervisor\Configuration\Section\GenericSection');
        $sections[0]->getProperty('key')->shouldReturn('value');
    }

    function it_parses_a_section()
    {
        $section = $this->parseSection('test', ['key' => 'value']);

        $section->shouldHaveType('Supervisor\Configuration\Section\GenericSection');
        $section->getProperty('key')->shouldReturn('value');
    }
}
