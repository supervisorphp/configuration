<?php

namespace Supervisor\Configuration;

use Supervisor\Configuration\Configuration;
use Supervisor\Configuration\Exception\WrittingFailed;

/**
 * Writes configuration to various destinations.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Writer
{
    /**
     * Writes a Configuration.
     *
     * @param Configuration $configuration
     *
     * @throws WrittingFailed If the configuration cannot be written
     */
    public function write(Configuration $configuration);
}
