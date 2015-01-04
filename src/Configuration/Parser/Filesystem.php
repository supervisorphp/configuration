<?php

/*
 * This file is part of the Indigo Supervisor package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Supervisor\Configuration\Parser;

use Indigo\Supervisor\Configuration;
use Indigo\Supervisor\Exception\ParsingFailed;
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

        $fileContents = $this->filesystem->read($this->file);

        $parser = new Text($fileContents);

        return $parser->parse($configuration);
    }
}
