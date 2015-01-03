<?php

namespace spec\Indigo\Supervisor\Configuration\Parser;

use Indigo\Supervisor\Configuration;
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
        $this->shouldHaveType('Indigo\Supervisor\Configuration\Parser\File');
    }

    function it_is_a_parser()
    {
        $this->shouldImplement('Indigo\Supervisor\Configuration\Parser');
    }

    function it_parses_configuration(Configuration $configuration)
    {
        $configuration->addSections(Argument::type('array'))->shouldBeCalled();

        $this->parse($configuration);
    }

    function it_parses_configuration_into_a_new_instance()
    {
        $configuration = $this->parse();

        $configuration->shouldHaveType('Indigo\Supervisor\Configuration');
    }

    function it_throws_an_exception_when_invalid_file_given()
    {
        $this->beConstructedWith('/invalid');

        $this->shouldThrow('Indigo\Supervisor\Exception\ParsingFailed')->duringParse();
    }

    function it_throws_an_exception_when_parsing_failed()
    {
        $this->beConstructedWith(__DIR__.'/../../../resources/invalid.conf');

        $this->shouldThrow('Indigo\Supervisor\Exception\ParsingFailed')->duringParse();
    }
}
