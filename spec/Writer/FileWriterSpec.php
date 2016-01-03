<?php

namespace spec\Supervisor\Configuration\Writer;

use Indigo\Ini\Renderer;
use League\Flysystem\Filesystem;
use Supervisor\Configuration\Configuration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileWriterSpec extends ObjectBehavior
{
    function let(Filesystem $filesystem)
    {
        $this->beConstructedWith($filesystem, 'file');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Configuration\Writer\FileWriter');
    }

    function it_is_a_writer()
    {
        $this->shouldImplement('Supervisor\Configuration\Writer');
    }

    function it_writes_a_configuration_to_a_file(Filesystem $filesystem, Configuration $configuration)
    {
        $configuration->toArray()->willReturn([]);

        $filesystem->put('file', '')->willReturn(true);

        $this->write($configuration)->shouldReturn(true);
    }

    function it_throws_an_exception_when_configuration_cannot_be_written(Filesystem $filesystem, Configuration $configuration)
    {
        $configuration->toArray()->willReturn([]);

        $filesystem->put('file', '')->willReturn(false);

        $this->shouldThrow('Supervisor\Configuration\Exception\WriterException')->duringWrite($configuration);
    }
}
