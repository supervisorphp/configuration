<?php

namespace Supervisor\Configuration\Section;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Group section.
 *
 * @link http://supervisord.org/configuration.html#group-x-section-settings
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Group extends Named
{
    /**
     * {@inheritdoc}
     */
    protected $sectionName = 'group';

    /**
     * {@inheritdoc}
     */
    protected function configureProperties(OptionsResolver $resolver)
    {
        $resolver->setRequired('programs');
        $this->configureArrayProperty('programs', $resolver);

        $resolver->setDefined('priority')
            ->setAllowedTypes('priority', 'integer');
    }
}
