<?php

namespace Supervisor\Configuration\Loader;

use Indigo\Ini\Exception\ParserException;
use Supervisor\Configuration;
use Supervisor\Exception\LoaderException;

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
    public function load(Configuration $configuration = null)
    {
        if (is_null($configuration)) {
            $configuration = new Configuration();
        }

        try {
            $ini = $this->getParser()->parse($this->text);
        } catch (ParserException $e) {
            throw new LoaderException('Cannot parse INI', 0, $e);
        }

        $sections = $this->parseArray($ini);
        $configuration->addSections($sections);

        return $configuration;
    }
}
