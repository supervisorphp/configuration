<?php

namespace Supervisor;

use Supervisor\Configuration\Section;

/**
 * Supervisor configuration parser and generator.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Configuration
{
    /**
     * Config sections.
     *
     * @var Section[]
     */
    protected $sections = [];

    /**
     * Returns a specific section by name.
     *
     * @param string $section
     *
     * @return Section|null
     */
    public function getSection($section)
    {
        if ($this->hasSection($section)) {
            return $this->sections[$section];
        }
    }

    /**
     * Checks whether section exists in Configuration.
     *
     * @param string $section
     *
     * @return bool
     */
    public function hasSection($section)
    {
        return array_key_exists($section, $this->sections);
    }

    /**
     * Adds or overrides a section.
     *
     * @param Section $section
     */
    public function addSection(Section $section)
    {
        $this->sections[$section->getName()] = $section;
    }

    /**
     * Removes a section by name.
     *
     * @param string $section
     *
     * @return bool
     */
    public function removeSection($section)
    {
        if ($has = $this->hasSection($section)) {
            unset($this->sections[$section]);
        }

        return $has;
    }

    /**
     * Returns all sections.
     *
     * @return Section[]
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * Adds or overrides an array sections.
     *
     * @param Section[] $sections
     */
    public function addSections(array $sections)
    {
        foreach ($sections as $section) {
            $this->addSection($section);
        }
    }

    /**
     * Resets Configuration.
     */
    public function reset()
    {
        $this->sections = [];
    }

    /**
     * Converts the configuration to array.
     *
     * @return array
     */
    public function toArray()
    {
        $ini = [];

        foreach ($this->sections as $sectionName => $section) {
            $ini[$sectionName] = $section->getProperties();
        }

        return $ini;
    }
}
