<?php

namespace spec\Supervisor\Stub;

use PhpSpec\ObjectBehavior;

class WriterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Stub\Writer');
        $this->shouldHaveType('Supervisor\Configuration\Writer\RendererAware');
    }

    function it_is_a_writer()
    {
        $this->shouldImplement('Supervisor\Configuration\Writer');
    }

    function it_has_a_renderer()
    {
        $this->getRenderer()->shouldHaveType('Supervisor\Configuration\Renderer');
    }
}
