<?php

namespace Supervisor\Configuration;

use Supervisor\Configuration;
use Supervisor\Exception\ParsingFailed;

/**
 * Parses configuration from various sources.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Parser
{
    /**
     * Parse an input to a configuration.
     *
     * @param Configuration|null $configuration If null passed, it is created automatically
     *
     * @return Configuration
     *
     * @throws ParsingFailed If the given data cannot be parsed
     */
    public function parse(Configuration $configuration = null);
}
