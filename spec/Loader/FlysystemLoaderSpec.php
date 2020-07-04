<?php

namespace spec\Supervisor\Configuration\Loader;

use League\Flysystem\Filesystem;
use Supervisor\Configuration\Configuration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Supervisor\Configuration\Loader\FlysystemLoader;
use Supervisor\Configuration\Loader\IniFileLoader;
use Supervisor\Configuration\Section\Supervisord;
use Supervisor\Configuration\Exception\LoaderException;

class FlysystemLoaderSpec extends ObjectBehavior
{
    use LoaderBehavior;

    function let(Filesystem $filesystem)
    {
        $this->beConstructedWith($filesystem, 'supervisord.conf');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(FlysystemLoader::class);
    }

    function it_loads_ini_configuration_from_file(Filesystem $filesystem, Configuration $configuration)
    {
        $configuration->findSection('supervisord')
            ->willReturn(Supervisord::class);

        $filesystem->has('supervisord.conf')
            ->willReturn(true);

        $filesystem->read(Argument::type('string'))
            ->willReturn("[supervisord]\nidentifier = supervisor");

        $configuration->addSection(Argument::type(Supervisord::class))
            ->shouldBeCalled();

        $newConfig = $this->load($configuration);

        $newConfig->shouldHaveType(Configuration::class);
        $newConfig->shouldBe($configuration);
    }

    function it_throws_an_exception_when_invalid_file_given(Filesystem $filesystem)
    {
        $filesystem->has('supervisord.conf')
            ->willReturn(false);

        $this->shouldThrow(LoaderException::class)
            ->duringLoad();
    }

    function it_throws_an_exception_when_cannot_read_file_given(Filesystem $filesystem)
    {
        $filesystem->has('supervisord.conf')
            ->willReturn(true);

        $filesystem->read('supervisord.conf')
            ->willReturn(false);

        $this->shouldThrow(LoaderException::class)
            ->duringLoad();
    }

    function it_throws_an_exception_when_file_contains_invalid_ini(Filesystem $filesystem)
    {
        $filesystem->has('supervisord.conf')
            ->willReturn(true);

        $filesystem->read('supervisord.conf')
            ->willReturn('?{}|&~![()^"');

        $this->shouldThrow(LoaderException::class)
            ->duringLoad();
    }
}
