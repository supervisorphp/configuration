<?php

namespace Supervisor\Configuration\Parser;

use Supervisor\Configuration;
use Supervisor\Exception\ParsingFailed;

/**
 * Parses a file.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class File extends Base
{
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
    public function parse(Configuration $configuration = null)
    {
        if (!is_file($this->file)) {
            throw new ParsingFailed(sprintf('File "%s" not found', $this->file));
        }

        if (is_null($configuration)) {
            $configuration = new Configuration();
        }

        // Suppress error to handle it
        if (false === $ini = @parse_ini_file($this->file, true, INI_SCANNER_RAW)) {
            throw new ParsingFailed(sprintf('File "%s" cannot be parsed as INI', $this->file));
        }

        $sections = $this->parseArray($ini);
        $configuration->addSections($sections);

        return $configuration;
    }
}
