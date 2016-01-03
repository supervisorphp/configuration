<?php

namespace Supervisor\Configuration\Writer;

use Supervisor\Configuration\Configuration;
use Indigo\Ini\Renderer;
use League\Flysystem\Filesystem as Flysystem;

/**
 * Write a configuration into any filesystem.
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
     * @param Flysystem $filesystem
     * @param string    $file
     */
    public function __construct(Flysystem $filesystem, $file)
    {
        $this->filesystem = $filesystem;

        parent::__construct($file);
    }

    /**
     * {@inheritdoc}
     */
    protected function writeFile($contents)
    {
        return $this->filesystem->put($this->file, $contents);
    }
}
