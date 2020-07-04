<?php
namespace Supervisor\Configuration\Loader;

use Indigo\Ini\Parser;
use Supervisor\Configuration\Configuration;
use Supervisor\Configuration\Section\GenericSection;

abstract class AbstractLoader implements LoaderInterface
{
    abstract public function load(Configuration $configuration = null): Configuration;

    /**
     * @var Parser
     */
    protected $parser;

    /**
     * Returns the INI parser.
     *
     * @return Parser
     */
    protected function getParser(): Parser
    {
        if (!isset($this->parser)) {
            $this->parser = new Parser();
        }

        return $this->parser;
    }

    /**
     * Parses a section array.
     *
     * @param array              $sections
     * @param Configuration|null $configuration
     *
     * @return Configuration
     */
    public function parseSections(array $sections, Configuration $configuration = null): Configuration
    {
        if (is_null($configuration)) {
            $configuration = new Configuration();
        }

        foreach ($sections as $sectionName => $section) {
            $name = explode(':', $sectionName, 2);

            $class = $configuration->findSection($name[0]);

            if (false === $class) {
                $class = GenericSection::class;
                $name[1] = $sectionName;
            }

            if (isset($name[1])) {
                $section = new $class($name[1], $section);
            } else {
                $section = new $class($section);
            }

            $configuration->addSection($section);
        }

        return $configuration;
    }
}
