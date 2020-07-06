<?php

namespace Supervisor\Configuration\Section;

/**
 * Section name contains identifier.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
final class GenericSection implements SectionInterface
{
    use SectionData;

    /**
     * @param string $name
     * @param array $properties
     */
    public function __construct($name, array $properties = [])
    {
        $this->name = trim($name);
        $this->properties = $properties;
    }
}
