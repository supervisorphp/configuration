<?php

namespace spec\Supervisor\Configuration\Loader;

use Supervisor\Configuration\Configuration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Supervisor\Configuration\Loader\IniStringLoader;
use Supervisor\Configuration\Section\Supervisord;
use Supervisor\Configuration\Exception\LoaderException;

class IniStringLoaderSpec extends ObjectBehavior
{
    use LoaderBehavior;

    function let()
    {
        $this->beConstructedWith("[supervisord]\nidentifier = supervisor");
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(IniStringLoader::class);
    }

    function it_loads_ini_configuration_from_string(Configuration $configuration)
    {
        $configuration->findSection('supervisord')
            ->willReturn(Supervisord::class);

        $configuration->addSection(Argument::type(Supervisord::class))
            ->shouldBeCalled();

        $newConfig = $this->load($configuration);

        $newConfig->shouldHaveType(Configuration::class);
        $newConfig->shouldBe($configuration);
    }

    function it_throws_an_exception_when_string_contains_invalid_ini()
    {
        $this->beConstructedWith('?{}|&~![()^"');

        $this->shouldThrow(LoaderException::class)
            ->duringLoad();
    }
}
