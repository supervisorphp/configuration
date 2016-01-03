<?php

namespace spec\Supervisor\Configuration\Writer;

use Supervisor\Configuration;
use Indigo\Ini\Renderer;
use League\Flysystem\Filesystem as Flysystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FilesystemSpec extends ObjectBehavior
{
    function let(Flysystem $filesystem)
    {
        $this->beConstructedWith($filesystem, 'file');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Configuration\Writer\Filesystem');
    }

    function it_is_a_writer()
    {
        $this->shouldImplement('Supervisor\Configuration\Writer');
    }

    function it_writes_a_configuration_to_a_file(Flysystem $filesystem, Configuration $configuration)
    {
        $configuration->toArray()->willReturn([]);

        $filesystem->put('file', '')->willReturn(true);
        $this->beConstructedWith($filesystem, 'file');

        $this->write($configuration)->shouldReturn(true);
    }

    function it_throws_an_exception_when_configuration_cannot_be_written(Flysystem $filesystem, Configuration $configuration)
    {
        $configuration->toArray()->willReturn([]);

        $filesystem->put('file', '')->willReturn(false);
        $this->beConstructedWith($filesystem, 'file');

        $this->shouldThrow('Supervisor\Exception\WrittingFailed')->duringWrite($configuration);
    }
}
