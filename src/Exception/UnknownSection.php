<?php

namespace Supervisor\Exception;

/**
 * Thrown when an invalid section is passed to the Configuration parser.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class UnknownSection extends \UnexpectedValueException
{
    /**
     * @param string $sectionName
     */
    public function __construct($sectionName)
    {
        parent::__construct(sprintf('Section "%s" is not found in the section map', $sectionName));
    }
}
