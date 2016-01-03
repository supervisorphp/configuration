<?php

namespace Supervisor\Configuration\Stub;

use Supervisor\Configuration\Loader\Base;
use Supervisor\Configuration\Configuration;

/**
 * Loader Stub
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Loader extends Base
{
    /**
     * {@inheritdoc}
     */
    public function load(Configuration $configuration = null)
    {
        // noop
    }
}
