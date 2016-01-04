<?php

namespace spec\Supervisor\Configuration\Section;

trait SectionBehavior
{
    function it_is_a_section()
    {
        $this->shouldImplement('Supervisor\Configuration\Section');
    }
}
