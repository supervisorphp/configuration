<?php

namespace spec\Supervisor\Configuration\Loader;

use Supervisor\Configuration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TextSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("[supervisord]\nidentifier = supervisor");
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Configuration\Loader\Text');
    }

    function it_is_a_parser()
    {
        $this->shouldImplement('Supervisor\Configuration\Loader');
    }

    function it_parses_configuration(Configuration $configuration)
    {
        $configuration->addSections(Argument::type('array'))->shouldBeCalled();

        $this->load($configuration);
    }

    function it_parses_configuration_into_a_new_instance()
    {
        $configuration = $this->load();

        $configuration->shouldHaveType('Supervisor\Configuration');
    }

    function it_throws_an_exception_when_parsing_failed()
    {
        $this->beConstructedWith('?{}|&~![()^"');

        $this->shouldThrow('Supervisor\Exception\LoaderException')->duringLoad();
    }
}
