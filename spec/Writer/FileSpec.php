<?php

namespace spec\Supervisor\Configuration\Writer;

use Supervisor\Configuration\Configuration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

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

    function it_writes_a_configuration_to_a_file(Configuration $configuration)
    {
        $configuration->toArray()->willReturn([]);

        $this->beConstructedWith(tempnam(sys_get_temp_dir(), 'supervisor'));

        $this->write($configuration)->shouldReturn(0);
    }

    function it_throws_an_exception_when_configuration_cannot_be_written(Configuration $configuration)
    {
        $configuration->toArray()->willReturn([]);

        $this->beConstructedWith('');

        $this->shouldThrow('Supervisor\Configuration\Exception\WrittingFailed')->duringWrite($configuration);
    }
}
