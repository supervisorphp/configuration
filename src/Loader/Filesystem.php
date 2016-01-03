<?php

namespace Supervisor\Configuration\Loader;

use Supervisor\Configuration\Configuration;
use Supervisor\Configuration\Exception\LoaderException;
use League\Flysystem\Filesystem as Flysystem;

/**
 * Read a file from any filesystem and parse it as string.
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
    public function load(Configuration $configuration = null)
    {
        if (is_null($configuration)) {
            $configuration = new Configuration();
        }

        if (!$this->filesystem->has($this->file)) {
            throw new LoaderException(sprintf('File "%s" not found', $this->file));
        }

        if (!$fileContents = $this->filesystem->read($this->file)) {
            throw new LoaderException(sprintf('Reading file "%s" failed', $this->file));
        }

        $ini = $this->getParser()->parse($fileContents);

        $sections = $this->parseArray($ini);
        $configuration->addSections($sections);

        return $configuration;
    }
}
