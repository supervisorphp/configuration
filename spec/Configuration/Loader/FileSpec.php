<?php

namespace spec\Supervisor\Configuration\Loader;

use Supervisor\Configuration;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FileSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(__DIR__.'/../../../resources/example.conf');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Supervisor\Configuration\Loader\File');
    }

    function it_is_a_loader()
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

    function it_throws_an_exception_when_invalid_file_given()
    {
        $this->beConstructedWith('/invalid');

        $this->shouldThrow('Supervisor\Exception\LoaderException')->duringLoad();
    }

    function it_throws_an_exception_when_parsing_failed()
    {
        $this->beConstructedWith(__DIR__.'/../../../resources/invalid.conf');

        $this->shouldThrow('Supervisor\Exception\LoaderException')->duringLoad();
    }
}
