<?php

/*
 * This file is part of the Indigo Supervisor package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Supervisor\Stub;

use Indigo\Supervisor\Configuration\Writer\RendererAware;
use Indigo\Supervisor\Configuration;

/**
 * Writer Stub
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Writer extends RendererAware
{
    /**
     * {@inheritdoc}
     */
    public function write(Configuration $configuration)
    {
        // noop
    }

    /**
     * Returns the renderer object
     *
     * @return Renderer
     */
    public function getRenderer()
    {
        return $this->renderer;
    }
}
