<?php

namespace Supervisor\Configuration\Section;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Fcgi Program section.
 *
 * @link http://supervisord.org/configuration.html#fcgi-program-x-section-settings
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class FcgiProgram extends Program
{
    /**
     * {@inheritdoc}
     */
    protected $sectionName = 'fcgi-program';

    /**
     * {@inheritdoc}
     */
    protected function configureProperties(OptionsResolver $resolver)
    {
        parent::configureProperties($resolver);

        $resolver
            ->setRequired('socket')
            ->setAllowedTypes('socket', 'string');

        $resolver
            ->setDefined('socket_owner')
            ->setAllowedTypes('socket_owner', 'string');

        // TODO: octal vs. decimal value
        $resolver->setDefined('socket_mode')
            ->setAllowedTypes('socket_mode', 'integer');
    }
}
