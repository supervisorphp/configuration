<?php

namespace Supervisor\Configuration\Section;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Supervisorctl section.
 *
 * @link http://supervisord.org/configuration.html#supervisorctl-section-settings
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Supervisorctl extends Base
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'supervisorctl';

    /**
     * {@inheritdoc}
     */
    protected function configureProperties(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined('serverurl')
            ->setAllowedTypes('serverurl', 'string');

        $resolver
            ->setDefined('username')
            ->setAllowedTypes('username', 'string');

        $resolver
            ->setDefined('password')
            ->setAllowedTypes('password', 'string');

        $resolver
            ->setDefined('prompt')
            ->setAllowedTypes('prompt', 'string');

        $resolver
            ->setDefined('history_file')
            ->setAllowedTypes('history_file', 'string');
    }
}
