<?php

namespace spec\Supervisor\Configuration\Parser;

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
        $this->shouldHaveType('Supervisor\Configuration\Parser\File');
    }

    function it_is_a_parser()
    {
        $this->shouldImplement('Supervisor\Configuration\Parser');
    }

    function it_parses_configuration(Configuration $configuration)
    {
        $configuration->addSections(Argument::type('array'))->shouldBeCalled();

        $this->parse($configuration);
    }

    function it_parses_configuration_into_a_new_instance()
    {
        $configuration = $this->parse();

        $configuration->shouldHaveType('Supervisor\Configuration');
    }

    function it_throws_an_exception_when_invalid_file_given()
    {
        $this->beConstructedWith('/invalid');

        $this->shouldThrow('Supervisor\Exception\ParsingFailed')->duringParse();
    }

    function it_throws_an_exception_when_parsing_failed()
    {
        $this->beConstructedWith(__DIR__.'/../../../resources/invalid.conf');

        $this->shouldThrow('Supervisor\Exception\ParsingFailed')->duringParse();
    }
}
