<?php

/*
 * This file is part of the Supervisor Configuration package.
 *
 * (c) Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Supervisor\Stub;

use Supervisor\Configuration\Parser\Base;
use Supervisor\Configuration;

/**
 * Parser Stub
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Parser extends Base
{
    /**
     * {@inheritdoc}
     */
    public function parse(Configuration $configuration = null)
    {
        // noop
    }
}
