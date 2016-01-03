<?php

namespace Supervisor\Configuration\Writer;

use Supervisor\Configuration\Configuration;
use Supervisor\Configuration\Writer;
use Supervisor\Configuration\Exception\WriterException;

/**
 * Writes a Configuration into a file.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class File implements Writer
{
    use HasRenderer;

    /**
     * @var string
     */
    protected $file;

    /**
     * @param string $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * {@inheritdoc}
     */
    public function write(Configuration $configuration)
    {
        $fileContents = $this->getRenderer()->render($configuration->toArray());

        if (false === $result = $this->writeFile($fileContents)) {
            throw new WriterException(sprintf('Cannot write configuration into file %s', $this->file));
        }

        return $result;
    }

    /**
     * Write contents into file.
     *
     * @param string $contents
     *
     * @return int|bool
     */
    protected function writeFile($contents)
    {
        return @file_put_contents($this->file, $contents);
    }
}
