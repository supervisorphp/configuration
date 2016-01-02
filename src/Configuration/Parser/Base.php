<?php

namespace Supervisor\Configuration\Parser;

use Supervisor\Configuration\Parser;
use Supervisor\Configuration;
use Supervisor\Exception\UnknownSection;

/**
 * Provides common functionality to parsers.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class Base implements Parser
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
     * Adds or overrides default section map.
     *
     * @param string $section
     * @param string $className
     */
    public function addSectionMap($section, $className)
    {
        $this->sectionMap[$section] = $className;
    }

    /**
     * Finds a section class by name.
     *
     * @param string $section
     *
     * @return string
     *
     * @throws UnknownException If section is not found in the section map
     */
    public function findSection($section)
    {
        if (!isset($this->sectionMap[$section])) {
            throw new UnknownSection($section);
        }

        return $this->sectionMap[$section];
    }

    /**
     * Parses an INI array.
     *
     * Sections must be included
     *
     * @param array $ini
     *
     * @return Section[]
     */
    public function parseArray(array $ini)
    {
        $sections = [];

        foreach ($ini as $name => $section) {
            $section = $this->parseSection($name, array_map('trim', $section));
            $sections[] = $section;
        }

        return $sections;
    }

    /**
     * Parses an individual section.
     *
     * @param string $name
     * @param array  $section Array representation of section
     *
     * @return Section
     */
    public function parseSection($name, array $section)
    {
        $name = explode(':', $name, 2);

        $class = $this->findSection($name[0]);

        if (isset($name[1])) {
            return new $class($name[1], $section);
        }

        return new $class($section);
    }
}
