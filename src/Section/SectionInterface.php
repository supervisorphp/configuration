<?php

namespace Supervisor\Configuration\Section;

/**
 * Properties are grouped into sections.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface SectionInterface
{
    /**
     * Returns the section name.
     *
     * Should be set explicitly for single sections (eg. supervisord)
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Returns a specific property.
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getProperty($key);

    /**
     * Checks if a property exists.
     *
     * @param string $key
     *
     * @return bool
     */
    public function hasProperty($key): bool;

    /**
     * Sets a specific property.
     *
     * @param string $key
     * @param mixed $value
     */
    public function setProperty($key, $value): void;

    /**
     * Returns the properties as an array.
     *
     * @return array
     */
    public function getProperties(): array;

    /**
     * Sets an array of properties.
     *
     * @param array $properties
     */
    public function setProperties(array $properties): void;
}
