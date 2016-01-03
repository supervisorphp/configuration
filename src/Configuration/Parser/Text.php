<?php

namespace Supervisor\Configuration\Parser;

use Supervisor\Configuration;
use Supervisor\Exception\ParsingFailed;

/**
 * Parse configuration from string.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Text extends Base
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @param string $text
     */
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * {@inheritdoc}
     */
    public function parse(Configuration $configuration = null)
    {
        if (is_null($configuration)) {
            $configuration = new Configuration();
        }

        $ini = $this->getParser()->parse($this->text);

        $sections = $this->parseArray($ini);
        $configuration->addSections($sections);

        return $configuration;
    }
}
