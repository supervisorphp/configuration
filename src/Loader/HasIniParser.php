<?php

namespace Supervisor\Configuration\Loader;

use Indigo\Ini\Parser;

/**
 * Provides an INI parser.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait HasIniParser
{
    /**
     * @var Parser
     */
    protected $parser;

    /**
     * Returns the INI parser.
     *
     * @return Parser
     */
    protected function getParser()
    {
        if (!isset($this->parser)) {
            $this->parser = new Parser();
        }

        return $this->parser;
    }
}
