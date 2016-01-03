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

    function it_returns_a_section(Section $supervisord)
    {
        $supervisord->getName()->willReturn('supervisord');

        $this->getSection('supervisord')->shouldReturn(null);

        $this->addSection($supervisord);

        $this->getSection('supervisord')->shouldReturn($supervisord);
    }

    function it_checks_a_section_existence(Section $supervisord)
    {
        $supervisord->getName()->willReturn('supervisord');

        $this->hasSection('supervisord')->shouldReturn(false);

        $this->addSection($supervisord);

        $this->hasSection('supervisord')->shouldReturn(true);
    }

    function it_removes_a_section(Section $supervisord)
    {
        $supervisord->getName()->willReturn('supervisord');

        $this->addSection($supervisord);

        $this->hasSection('supervisord')->shouldReturn(true);

        $this->removeSection('supervisord')->shouldReturn(true);

        $this->hasSection('supervisord')->shouldReturn(false);
    }

    function it_returns_sections(Section $supervisord)
    {
        $supervisord->getName()->willReturn('supervisord');

        $this->getSections()->shouldReturn([]);

        $this->addSection($supervisord);

        $this->getSections()->shouldReturn(['supervisord' => $supervisord]);
    }

    function it_accepts_sections(Section $supervisord)
    {
        $supervisord->getName()->willReturn('supervisord');

        $this->addSections([$supervisord]);

        $this->getSections()->shouldReturn(['supervisord' => $supervisord]);
    }

    function it_resets_sections(Section $supervisord)
    {
        $supervisord->getName()->willReturn('supervisord');

        $this->addSection($supervisord);

        $this->reset();

        $this->getSections()->shouldReturn([]);
    }
}
