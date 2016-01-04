<?php

namespace spec\Supervisor\Configuration\Loader;

use Supervisor\Configuration\Configuration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class IniStringLoaderSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("[supervisord]\nidentifier = supervisor");
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Configuration\Loader\IniStringLoader');
    }

    function it_loads_ini_configuration_from_string(Configuration $configuration)
    {
        $configuration->findSection('supervisord')->willReturn('Supervisor\Configuration\Section\Supervisord');

        $configuration->addSection(Argument::type('Supervisor\Configuration\Section\Supervisord'))->shouldBeCalled();

        $newConfig = $this->load($configuration);

        $newConfig->shouldHaveType('Supervisor\Configuration\Configuration');
        $newConfig->shouldBe($configuration);
    }

    function it_throws_an_exception_when_string_contains_invalid_ini()
    {
        $this->beConstructedWith('?{}|&~![()^"');

        $this->shouldThrow('Supervisor\Configuration\Exception\LoaderException')->duringLoad();
    }
}
