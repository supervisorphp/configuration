<?php

namespace spec\Indigo\Supervisor\Stub;

use PhpSpec\ObjectBehavior;

class WriterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Supervisor\Stub\Writer');
        $this->shouldHaveType('Indigo\Supervisor\Configuration\Writer\RendererAware');
    }

    function it_is_a_writer()
    {
        $this->shouldImplement('Indigo\Supervisor\Configuration\Writer');
    }

    function it_has_a_renderer()
    {
        $this->getRenderer()->shouldHaveType('Indigo\Supervisor\Configuration\Renderer');
    }
}
