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

use Supervisor\Configuration\Writer\RendererAware;
use Supervisor\Configuration;

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
