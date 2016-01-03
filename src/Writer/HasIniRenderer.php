<?php

namespace Supervisor\Configuration\Writer;

use Indigo\Ini\Renderer;

/**
 * Provides an INI Renderer.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait HasIniRenderer
{
    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * @return Renderer
     */
    protected function getRenderer()
    {
        if (!isset($this->renderer)) {
            $this->renderer = new Renderer(Renderer::ARRAY_MODE_CONCAT, Renderer::BOOLEAN_MODE_BOOL_STRING);
        }

        return $this->renderer;
    }
}
