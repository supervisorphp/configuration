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
use League\Flysystem\Filesystem as Flysystem;

/**
 * Read a file from any filesystem and parse it as string
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Filesystem extends Text
{
    /**
     * @var Flysystem
     */
    protected $filesystem;

    /**
     * @var string
     */
    protected $file;

    /**
     * @param Flysystem $filesystem
     */
    public function __construct(Flysystem $filesystem, $file)
    {
        if (!$filesystem->has($file)) {
            throw new \InvalidArgumentException(sprintf('File "%s" not found', $file));
        }

        $this->filesystem = $filesystem;
        $this->file = $file;
    }

    /**
     * {@inheritdoc}
     */
    public function parse(Configuration $configuration = null)
    {
        $this->text = $this->filesystem->read($this->file);

        return parent::parse($configuration);
    }
}
