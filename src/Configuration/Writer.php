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
use Supervisor\Exception\WrittingFailed;

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
