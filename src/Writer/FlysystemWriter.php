<?php

namespace Supervisor\Configuration\Writer;

use League\Flysystem\Filesystem;
use Supervisor\Configuration\Configuration;
use Supervisor\Configuration\Exception\WriterException;

/**
 * Write a configuration into any filesystem.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class FlysystemWriter extends AbstractWriter
{
    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var string
     */
    private $file;

    /**
     * @param Filesystem $filesystem
     * @param string     $file
     */
    public function __construct(Filesystem $filesystem, $file)
    {
        $this->filesystem = $filesystem;
        $this->file = $file;
    }

    /**
     * {@inheritdoc}
     */
    public function write(Configuration $configuration): void
    {
        $ini = $this->getRenderer()->render($configuration->toArray());

        if (false === $result = $this->filesystem->put($this->file, $ini)) {
            throw new WriterException(sprintf('Cannot write configuration into file %s', $this->file));
        }
    }
}
