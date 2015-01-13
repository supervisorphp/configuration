<?php

/*
 * This file is part of the Supervisor Configuration package.
 *
 * (c) Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Supervisor\Configuration\Parser;

use Supervisor\Configuration;
use Supervisor\Exception\ParsingFailed;
use League\Flysystem\Filesystem as Flysystem;

/**
 * Read a file from any filesystem and parse it as string
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
    public function parse(Configuration $configuration = null)
    {
        if (!$this->filesystem->has($this->file)) {
            throw new ParsingFailed(sprintf('File "%s" not found', $this->file));
        }

        if (!$fileContents = $this->filesystem->read($this->file)) {
            throw new ParsingFailed(sprintf('Reading file "%s" failed', $this->file));
        }

        $parser = new Text($fileContents);

        return $parser->parse($configuration);
    }
}
