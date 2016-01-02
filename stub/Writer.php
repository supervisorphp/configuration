<?php

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
