<?php
namespace Supervisor\Configuration\Writer;

use Indigo\Ini\Renderer;
use Supervisor\Configuration\Configuration;

abstract class AbstractWriter implements WriterInterface
{
    abstract public function write(Configuration $configuration);

    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * @return Renderer
     */
    protected function getRenderer(): Renderer
    {
        if (!isset($this->renderer)) {
            $this->renderer = new Renderer(Renderer::ARRAY_MODE_CONCAT | Renderer::BOOLEAN_MODE_BOOL_STRING);
        }

        return $this->renderer;
    }
}
