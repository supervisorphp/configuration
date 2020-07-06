<?php
namespace Supervisor\Configuration;

use Supervisor\Configuration\Section\SectionInterface;

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
        'eventlistener' => Section\EventListener::class,
        'fcgi-program' => Section\FcgiProgram::class,
        'group' => Section\Group::class,
        'include' => Section\Includes::class,
        'inet_http_server' => Section\InetHttpServer::class,
        'program' => Section\Program::class,
        'supervisorctl' => Section\Supervisorctl::class,
        'supervisord' => Section\Supervisord::class,
        'unix_http_server' => Section\UnixHttpServer::class,
        'rpcinterface' => Section\RpcInterface::class,
    ];

    /**
     * Config sections.
     *
     * @var SectionInterface[]
     */
    protected $sections = [];

    /**
     * Returns a specific section by name.
     *
     * @param string $section
     *
     * @return SectionInterface|null
     */
    public function getSection(string $section): ?SectionInterface
    {
        if ($this->hasSection($section)) {
            return $this->sections[$section];
        }
        return null;
    }

    /**
     * Checks whether section exists in Configuration.
     *
     * @param string $section
     *
     * @return bool
     */
    public function hasSection(string $section): bool
    {
        return array_key_exists($section, $this->sections);
    }

    /**
     * Adds or overrides a section.
     *
     * @param SectionInterface $section
     */
    public function addSection(SectionInterface $section): void
    {
        $this->sections[$section->getName()] = $section;
    }

    /**
     * Removes a section by name.
     *
     * @param string $section
     *
     * @return bool Whether the section existed before this function call.
     */
    public function removeSection($section): bool
    {
        if ($has = $this->hasSection($section)) {
            unset($this->sections[$section]);
        }

        return $has;
    }

    /**
     * Returns all sections.
     *
     * @return SectionInterface[]
     */
    public function getSections(): array
    {
        return $this->sections;
    }

    /**
     * Adds or overrides an array sections.
     *
     * @param SectionInterface[] $sections
     */
    public function addSections(array $sections): void
    {
        foreach ($sections as $section) {
            $this->addSection($section);
        }
    }

    /**
     * Resets Configuration.
     */
    public function reset(): void
    {
        $this->sections = [];
    }

    /**
     * Converts the configuration to array.
     *
     * @return array
     */
    public function toArray(): array
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
    public function mapSection($section, $className): void
    {
        if (false === class_exists($className)) {
            throw new \InvalidArgumentException('This section class does not exist');
        }
        if (false === is_a($className, SectionInterface::class, true)) {
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
        return $this->sectionMap[$section] ?? false;
    }
}
