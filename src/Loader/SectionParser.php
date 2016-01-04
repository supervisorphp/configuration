<?php

namespace Supervisor\Configuration\Loader;

use Supervisor\Configuration\Configuration;

/**
 * Parses a section array.
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
trait SectionParser
{
    /**
     * Parses a section array.
     *
     * @param array              $sections
     * @param Configuration|null $configuration
     *
     * @return Configuration
     */
    public function parseSections(array $sections, Configuration $configuration = null)
    {
        if (is_null($configuration)) {
            $configuration = new Configuration();
        }

        foreach ($sections as $sectionName => $section) {
            $name = explode(':', $sectionName, 2);

            $class = $configuration->findSection($name[0]);

            if (false === $class) {
                $class = 'Supervisor\Configuration\Section\GenericSection';
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
