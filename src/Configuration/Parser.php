<?php

/*
 * This file is part of the Supervisor Configuration package.
 *
 * (c) Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
