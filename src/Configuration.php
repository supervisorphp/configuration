<?php

namespace Supervisor\Configuration;

/**
 * Supervisor configuration parser and generator.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Configuration
{
    /**
     * Available sections.
     *
     * @var array
     */
    protected $sectionMap = [
        'eventlistener'    => 'Supervisor\Configuration\Section\EventListener',
        'fcgi-program'     => 'Supervisor\Configuration\Section\FcgiProgram',
        'group'            => 'Supervisor\Configuration\Section\Group',
        'include'          => 'Supervisor\Configuration\Section\Includes',
        'inet_http_server' => 'Supervisor\Configuration\Section\InetHttpServer',
        'program'          => 'Supervisor\Configuration\Section\Program',
        'supervisorctl'    => 'Supervisor\Configuration\Section\Supervisorctl',
        'supervisord'      => 'Supervisor\Configuration\Section\Supervisord',
        'unix_http_server' => 'Supervisor\Configuration\Section\UnixHttpServer',
        'rpcinterface'     => 'Supervisor\Configuration\Section\RpcInterface',
    ];

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

    /**
     * Adds or overrides a default section mapping.
     *
     * @param string $section
     * @param string $className
     */
    public function mapSection($section, $className)
    {
        if (false === class_exists($className)) {
            throw new \InvalidArgumentException('This section class does not exist');
        } elseif (false === is_a($className, 'Supervisor\Configuration\Section', true)) {
            throw new \InvalidArgumentException('This section class must implement Supervisor\Configuration\Section');
        }

        $this->sectionMap[$section] = $className;
    }

    /**
     * Finds a section class by name.
     *
     * @param string $section
     *
     * @return string|bool
     */
    public function findSection($section)
    {
        if (isset($this->sectionMap[$section])) {
            return $this->sectionMap[$section];
        }

        return false;
    }
}
