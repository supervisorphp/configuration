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

/**
 * Parses a file
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
            $configuration = new Configuration;
        }

        // Suppress error to handle it
        if (!$ini = @parse_ini_file($this->file, true, INI_SCANNER_RAW)) {
            throw new ParsingFailed(sprintf('File "%s" cannot be parsed as INI', $this->file));
        }

        $sections = $this->parseArray($ini);
        $configuration->addSections($sections);

        return $configuration;
    }
}
