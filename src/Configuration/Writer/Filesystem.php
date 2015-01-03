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
use League\Flysystem\Filesystem as Flysystem;

/**
 * Write a configuration into any filesystem
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Filesystem extends File
{
    /**
     * @var Flysystem
     */
    protected $filesystem;

    /**
     * @param Flysystem     $filesystem
     * @param string        $file
     * @param Renderer|null $renderer
     */
    public function __construct(Flysystem $filesystem, $file, Renderer $renderer = null)
    {
        $this->filesystem = $filesystem;

        parent::__construct($file, $renderer);
    }

    /**
     * {@inheritdocs}
     */
    protected function writeFile($contents)
    {
        return $this->filesystem->put($this->file, $contents);
    }
}
