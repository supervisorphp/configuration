<?php

namespace Supervisor\Configuration;

use Supervisor\Configuration\Exception\LoaderException;

/**
 * Load configuration from various sources.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Loader
{
    /**
     * Load an input to a configuration.
     *
     * @param Configuration|null $configuration If null passed, it is created automatically
     *
     * @return Configuration
     *
     * @throws LoaderException If the given data cannot be parsed
     */
    public function load(Configuration $configuration = null);
}
