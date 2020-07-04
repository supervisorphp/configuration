<?php

namespace Supervisor\Configuration\Writer;

use Supervisor\Configuration\Configuration;
use Supervisor\Configuration\Exception\WriterException;

/**
 * Writes configuration to various destinations.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface WriterInterface
{
    /**
     * Writes a Configuration.
     *
     * @param Configuration $configuration
     *
     * @throws WriterException
     */
    public function write(Configuration $configuration);
}
