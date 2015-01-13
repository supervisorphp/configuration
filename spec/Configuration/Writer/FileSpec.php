<?php

namespace spec\Supervisor\Configuration\Writer;

use Supervisor\Configuration;
use Supervisor\Configuration\Renderer;
use PhpSpec\ObjectBehavior;

class FileSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(tempnam(sys_get_temp_dir(), 'supervisor'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Configuration\Writer\File');
    }

    function it_is_a_writer()
    {
        $this->shouldImplement('Supervisor\Configuration\Writer');
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

        $this->shouldThrow('Supervisor\Exception\WrittingFailed')->duringWrite($configuration);
    }
}
