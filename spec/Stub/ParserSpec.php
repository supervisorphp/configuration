<?php

namespace spec\Supervisor\Stub;

use PhpSpec\ObjectBehavior;

class ParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Stub\Parser');
        $this->shouldHaveType('Supervisor\Configuration\Parser\Base');
    }

    function it_is_a_parser()
    {
        $this->shouldImplement('Supervisor\Configuration\Parser');
    }

    function it_accepts_a_section_to_the_map()
    {
        $this->addSectionMap('test', 'stdClass');

        $this->findSection('test')->shouldReturn('stdClass');
    }

    function it_throws_an_exception_when_section_not_found()
    {
        $this->shouldThrow('Supervisor\Exception\UnknownSection')->duringFindSection('invalid');
    }

    function it_parses_an_array()
    {
        $this->addSectionMap('test', 'Supervisor\Stub\Section');
        $sections = $this->parseArray(['test' => ['key' => 'value']]);

        $sections->shouldBeArray();
        $sections[0]->shouldHaveType('Supervisor\Stub\Section');
        $sections[0]->getProperty('key')->shouldReturn('value');
    }

    function it_parses_a_section()
    {
        $this->addSectionMap('test', 'Supervisor\Stub\Section');
        $section = $this->parseSection('test', ['key' => 'value']);

        $section->shouldHaveType('Supervisor\Stub\Section');
        $section->getProperty('key')->shouldReturn('value');
    }
}
