<?php

namespace spec\Indigo\Supervisor\Configuration\Parser;

use Indigo\Supervisor\Configuration;
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
        $this->shouldHaveType('Indigo\Supervisor\Configuration\Parser\Text');
    }

    function it_is_a_parser()
    {
        $this->shouldImplement('Indigo\Supervisor\Configuration\Parser');
    }

    function it_throws_an_exception_when_invalid_text_given()
    {
        $this->shouldThrow('InvalidArgumentException')->during('__construct', [null]);
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

    function it_throws_an_exception_when_parsing_failed()
    {
        $this->beConstructedWith('?{}|&~![()^"');

        $this->shouldThrow('Indigo\Supervisor\Exception\ParsingFailed')->duringParse();
    }
}
