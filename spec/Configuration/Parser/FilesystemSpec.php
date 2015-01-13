<?php

namespace spec\Supervisor\Configuration\Parser;

use Supervisor\Configuration;
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
        $this->shouldHaveType('Supervisor\Configuration\Parser\Filesystem');
    }

    function it_is_a_parser()
    {
        $this->shouldImplement('Supervisor\Configuration\Parser');
    }

    function it_parses_configuration(Flysystem $filesystem, Configuration $configuration)
    {
        $configuration->addSections(Argument::type('array'))->shouldBeCalled();
        $filesystem->read(Argument::type('string'))->willReturn("[supervisord]\nidentifier = supervisor");

        $this->parse($configuration);
    }

    function it_throws_an_exception_when_invalid_file_given(Flysystem $filesystem)
    {
        $filesystem->has(null)->willReturn(false);
        $this->beConstructedWith($filesystem, null);

        $this->shouldThrow('Supervisor\Exception\ParsingFailed')->duringParse();
    }
}
