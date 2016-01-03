<?php

namespace Supervisor\Configuration\Section;

/**
 * Holds all common section data.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait SectionData
{
    /**
     * Name of section (eg. supervisord or program:test).
     *
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $properties;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     */
    public function getProperty($key)
    {
        if (isset($this->properties[$key])) {
            return $this->properties[$key];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasProperty($key)
    {
        return isset($this->properties[$key]);
    }

    /**
     * {@inheritdoc}
     */
    public function setProperty($key, $value)
    {
        $this->properties[$key] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * {@inheritdoc}
     */
    public function setProperties(array $properties)
    {
        $this->properties = $properties;
    }
}
