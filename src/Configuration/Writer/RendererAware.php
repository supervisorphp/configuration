<?php

/*
 * This file is part of the Indigo Supervisor package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Supervisor\Configuration\Writer;

use Indigo\Supervisor\Configuration\Writer;
use Indigo\Supervisor\Configuration\Renderer;

/**
 * Accepts a Renderer instance to render a configuration into string
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class RendererAware implements Writer
{
    /**
     * @var Renderer
     */
    protected $renderer;

    /**
     * @param Renderer|null $renderer
     */
    public function __construct(Renderer $renderer = null)
    {
        $this->renderer = $renderer ?: new Renderer;
    }
}
