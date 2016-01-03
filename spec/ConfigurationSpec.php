<?php

namespace spec\Supervisor\Configuration;

use Supervisor\Configuration\Section;
use PhpSpec\ObjectBehavior;

class ConfigurationSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Configuration\Configuration');
    }

    function it_has_a_section(Section $section)
    {
        $section->getName()->willReturn('section');

        $this->getSection('section')->shouldReturn(null);
        $this->hasSection('section')->shouldReturn(false);

        $this->addSection($section);

        $this->getSection('section')->shouldReturn($section);
        $this->hasSection('section')->shouldReturn(true);
    }

    function it_removes_a_section(Section $section)
    {
        $section->getName()->willReturn('section');

        $this->addSection($section);

        $this->hasSection('section')->shouldReturn(true);

        $this->removeSection('section')->shouldReturn(true);

        $this->hasSection('section')->shouldReturn(false);
    }

    function it_has_sections(Section $section)
    {
        $section->getName()->willReturn('section');

        $this->getSections()->shouldReturn([]);

        $this->addSection($section);

        $this->getSections()->shouldReturn(['section' => $section]);
    }

    function it_accepts_sections(Section $section)
    {
        $section->getName()->willReturn('section');

        $this->addSections([$section]);

        $this->getSections()->shouldReturn(['section' => $section]);
    }

    function it_resets_sections(Section $section)
    {
        $section->getName()->willReturn('section');

        $this->addSection($section);

        $this->reset();

        $this->getSections()->shouldReturn([]);
    }

    function it_maps_a_section_to_a_class()
    {
        $this->mapSection('section', 'Supervisor\Configuration\Section\GenericSection');

        $this->findSection('section')->shouldReturn('Supervisor\Configuration\Section\GenericSection');
    }

    function it_returns_false_when_a_mapping_is_not_found()
    {
        $this->findSection('section')->shouldReturn(false);
    }

    function it_throws_an_exception_when_mapped_class_does_not_exist()
    {
        $this->shouldThrow('InvalidArgumentException')->duringMapSection('section', 'invalid_class');
    }

    function it_throws_an_exception_when_mapped_class_is_not_a_section()
    {
        $this->shouldThrow('InvalidArgumentException')->duringMapSection('section', 'stdClass');
    }
}
