<?php

namespace spec\Supervisor\Configuration\Loader;

use Supervisor\Configuration\Configuration;
use League\Flysystem\Filesystem as Flysystem;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FilesystemSpec extends ObjectBehavior
{
    function let(Flysystem $filesystem)
    {
        $filesystem->has(Argument::type('string'))->willReturn(true);

        $this->beConstructedWith($filesystem, 'supervisord.conf');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Configuration\Loader\Filesystem');
    }

    function it_is_a_loader()
    {
        $this->shouldImplement('Supervisor\Configuration\Loader');
    }

    function it_parses_configuration(Flysystem $filesystem, Configuration $configuration)
    {
        $configuration->addSections(Argument::type('array'))->shouldBeCalled();
        $filesystem->read(Argument::type('string'))->willReturn("[supervisord]\nidentifier = supervisor");

        $this->load($configuration);
    }

    function it_throws_an_exception_when_invalid_file_given(Flysystem $filesystem)
    {
        $filesystem->has(null)->willReturn(false);
        $this->beConstructedWith($filesystem, null);

        $this->shouldThrow('Supervisor\Configuration\Exception\LoaderException')->duringLoad();
    }

    function it_throws_an_exception_when_cannot_read_file_given(Flysystem $filesystem)
    {
        $filesystem->read('supervisord.conf')->willReturn(false);

        $this->shouldThrow('Supervisor\Configuration\Exception\LoaderException')->duringLoad();
    }
}
