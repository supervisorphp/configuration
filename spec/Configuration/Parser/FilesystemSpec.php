<?php

namespace spec\Indigo\Supervisor\Configuration\Parser;

use Indigo\Supervisor\Configuration;
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
        $this->shouldHaveType('Indigo\Supervisor\Configuration\Parser\Filesystem');
        $this->shouldHaveType('Indigo\Supervisor\Configuration\Parser');
    }

    function it_should_throw_an_exception_when_invalid_file_given(Flysystem $filesystem)
    {
        $filesystem->has(null)->willReturn(false);

        $this->shouldThrow('InvalidArgumentException')->during('__construct', [$filesystem, null]);
    }

    function it_should_allow_to_parse(Flysystem $filesystem, Configuration $configuration)
    {
        $configuration->addSections(Argument::type('array'))->shouldBeCalled();
        $filesystem->read(Argument::type('string'))->willReturn("[supervisord]\nidentifier = supervisor");

        $this->parse($configuration);
    }
}
