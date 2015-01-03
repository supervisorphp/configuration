<?php

namespace spec\Indigo\Supervisor\Configuration\Writer;

use Indigo\Supervisor\Configuration;
use Indigo\Supervisor\Configuration\Renderer;
use PhpSpec\ObjectBehavior;

class FileSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(tempnam(sys_get_temp_dir(), 'supervisor'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Supervisor\Configuration\Writer\File');
    }

    function it_is_a_writer()
    {
        $this->shouldImplement('Indigo\Supervisor\Configuration\Writer');
    }

    function it_writes_a_configuration_to_a_file(Renderer $renderer, Configuration $configuration)
    {
        $renderer->render($configuration)->willReturn('contents');
        $this->beConstructedWith(tempnam(sys_get_temp_dir(), 'supervisor'), $renderer);

        $this->write($configuration)->shouldReturn(8);
    }

    function it_throws_an_exception_when_configuration_cannot_be_written(Renderer $renderer, Configuration $configuration)
    {
        $renderer->render($configuration)->willReturn('contents');
        $this->beConstructedWith('', $renderer);

        $this->shouldThrow('Indigo\Supervisor\Exception\WrittingFailed')->duringWrite($configuration);
    }
}
