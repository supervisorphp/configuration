<?php

/*
 * This file is part of the Indigo Supervisor package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Supervisor\Configuration;

use Indigo\Supervisor\Configuration;
use Indigo\Supervisor\Exception\WrittingFailed;

/**
 * Writes configuration to various destinations
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Writer
{
    /**
     * Writes a Configuration
     *
     * @param Configuration $configuration
     *
     * @throws WrittingFailed If the configuration cannot be written
     */
    public function write(Configuration $configuration);
}
