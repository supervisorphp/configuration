<?php

namespace Supervisor\Configuration\Loader;

use Indigo\Ini\Exception\ParserException;
use Supervisor\Configuration\Configuration;
use Supervisor\Configuration\Exception\LoaderException;

/**
 * Parses INI configuration from string.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class IniStringLoader extends AbstractLoader
{
    /**
     * @var string
     */
    private $string;

    /**
     * @param string $string
     */
    public function __construct($string)
    {
        $this->string = $string;
    }

    /**
     * {@inheritdoc}
     */
    public function load(Configuration $configuration = null): Configuration
    {
        try {
            $ini = $this->getParser()->parse($this->string);
        } catch (ParserException $e) {
            throw new LoaderException('Cannot parse INI', 0, $e);
        }

        return $this->parseSections($ini, $configuration);
    }
}
