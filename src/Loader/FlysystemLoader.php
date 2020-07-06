<?php

namespace Supervisor\Configuration\Loader;

use Indigo\Ini\Exception\ParserException;
use League\Flysystem\Filesystem;
use Supervisor\Configuration\Configuration;
use Supervisor\Configuration\Exception\LoaderException;

/**
 * Read a file from any filesystem and parse it as INI string.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class FlysystemLoader extends AbstractLoader
{
    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var string
     */
    protected $file;

    /**
     * @param Filesystem $filesystem
     * @param string $file
     */
    public function __construct(Filesystem $filesystem, string $file)
    {
        $this->filesystem = $filesystem;
        $this->file = $file;
    }

    /**
     * {@inheritdoc}
     */
    public function load(Configuration $configuration = null): Configuration
    {
        if (!$this->filesystem->has($this->file)) {
            throw new LoaderException(sprintf('File "%s" not found', $this->file));
        }

        if (!$fileContents = $this->filesystem->read($this->file)) {
            throw new LoaderException(sprintf('Reading file "%s" failed', $this->file));
        }

        try {
            $ini = $this->getParser()->parse($fileContents);
        } catch (ParserException $e) {
            throw new LoaderException('Cannot parse INI', 0, $e);
        }

        return $this->parseSections($ini, $configuration);
    }
}
