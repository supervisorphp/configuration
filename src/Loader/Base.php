<?php

namespace Supervisor\Configuration\Loader;

use Indigo\Ini\Parser;
use Supervisor\Configuration\Loader;
use Supervisor\Configuration\Exception\UnknownSection;

/**
 * Provides common functionality to parsers.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
abstract class Base implements Loader
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
     * @var Parser
     */
    protected $parser;

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
     * @return string|bool
     */
    public function findSection($section)
    {
        if (isset($this->sectionMap[$section])) {
            return $this->sectionMap[$section];
        }

        return false;
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
     * @param string $sectionName
     * @param array  $section
     *
     * @return Section
     */
    public function parseSection($sectionName, array $section)
    {
        $name = explode(':', $sectionName, 2);

        $class = $this->findSection($name[0]);

        if (false === $class) {
            $class = 'Supervisor\Configuration\Section\GenericSection';
            $name[1] = $sectionName;
        }

        if (isset($name[1])) {
            return new $class($name[1], $section);
        }

        return new $class($section);
    }

    /**
     * Returns the INI parser.
     *
     * @return Parser
     */
    protected function getParser()
    {
        if (!isset($this->parser)) {
            $this->parser = new Parser();
        }

        return $this->parser;
    }
}
