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

use Indigo\Supervisor\Configuration;
use Indigo\Supervisor\Configuration\Renderer;
use Indigo\Supervisor\Exception\WrittingFailed;

/**
 * Writes a Configuration into a file
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class File extends RendererAware
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @param string        $file
     * @param Renderer|null $renderer
     */
    public function __construct($file, Renderer $renderer = null)
    {
        $this->file = $file;

        parent::__construct($renderer);
    }

    /**
     * {@inheritdoc}
     */
    public function write(Configuration $configuration)
    {
        $fileContents = $this->renderer->render($configuration);

        if (!$result = $this->writeFile($fileContents)) {
            throw new WrittingFailed(sprintf('Cannot write configuration into file %s', $this->file));
        }

        return $result;
    }

    /**
     * Write contents into file
     *
     * @param string $contents
     *
     * @return integer|boolean
     */
    protected function writeFile($contents)
    {
        return @file_put_contents($this->file, $contents);
    }
}
