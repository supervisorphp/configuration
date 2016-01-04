<?php

namespace spec\Supervisor\Configuration\Loader;

use League\Flysystem\Filesystem;
use Supervisor\Configuration\Configuration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IniFileLoaderSpec extends ObjectBehavior
{
    use LoaderBehavior;

    function let(Filesystem $filesystem)
    {
        $this->beConstructedWith($filesystem, 'supervisord.conf');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Configuration\Loader\IniFileLoader');
    }

    function it_loads_ini_configuration_from_file(Filesystem $filesystem, Configuration $configuration)
    {
        $configuration->findSection('supervisord')->willReturn('Supervisor\Configuration\Section\Supervisord');

        $filesystem->has('supervisord.conf')->willReturn(true);
        $filesystem->read(Argument::type('string'))->willReturn("[supervisord]\nidentifier = supervisor");

        $configuration->addSection(Argument::type('Supervisor\Configuration\Section\Supervisord'))->shouldBeCalled();

        $newConfig = $this->load($configuration);

        $newConfig->shouldHaveType('Supervisor\Configuration\Configuration');
        $newConfig->shouldBe($configuration);
    }

    function it_throws_an_exception_when_invalid_file_given(Filesystem $filesystem)
    {
        $filesystem->has('supervisord.conf')->willReturn(false);

        $this->shouldThrow('Supervisor\Configuration\Exception\LoaderException')->duringLoad();
    }

    function it_throws_an_exception_when_cannot_read_file_given(Filesystem $filesystem)
    {
        $filesystem->has('supervisord.conf')->willReturn(true);
        $filesystem->read('supervisord.conf')->willReturn(false);

        $this->shouldThrow('Supervisor\Configuration\Exception\LoaderException')->duringLoad();
    }

    function it_throws_an_exception_when_file_contains_invalid_ini(Filesystem $filesystem)
    {
        $filesystem->has('supervisord.conf')->willReturn(true);
        $filesystem->read('supervisord.conf')->willReturn('?{}|&~![()^"');

        $this->shouldThrow('Supervisor\Configuration\Exception\LoaderException')->duringLoad();
    }
}
