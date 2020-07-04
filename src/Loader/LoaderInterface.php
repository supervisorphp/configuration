<?php

namespace Supervisor\Configuration\Loader;

use Supervisor\Configuration\Configuration;
use Supervisor\Configuration\Exception\LoaderException;

/**
 * Load configuration from various sources.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface LoaderInterface
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
    public function load(Configuration $configuration = null): Configuration;
}
