<?php

namespace Supervisor\Configuration\Section;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Supervisord section.
 *
 * @link http://supervisord.org/configuration.html#supervisord-section-settings
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Supervisord extends Base
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'supervisord';

    protected function configureProperties(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined('logfile')
            ->setAllowedTypes('logfile', 'string');

        $resolver->setDefined('logfile_maxbytes');
        $this->configureByteProperty('logfile_maxbytes', $resolver);

        $resolver->setDefined('logfile_backups')
            ->setAllowedTypes('logfile_backups', 'integer');

        $resolver
            ->setDefined('loglevel')
            ->setAllowedTypes('loglevel', 'string')
            ->setAllowedValues('loglevel', ['critical', 'error', 'warn', 'info', 'debug', 'trace', 'blather']);

        $resolver
            ->setDefined('pidfile')
            ->setAllowedTypes('pidfile', 'string');

        // TODO: octal vs. decimal value
        $resolver->setDefined('umask')
            ->setAllowedTypes('umask', 'integer');

        $resolver->setDefined('nodaemon')
            ->setAllowedTypes('nodaemon', 'bool');

        $resolver->setDefined('minfds')
            ->setAllowedTypes('minfds', 'integer');

        $resolver->setDefined('minprocs')
            ->setAllowedTypes('minprocs', 'integer');

        $resolver->setDefined('nocleanup')
            ->setAllowedTypes('nocleanup', 'bool');

        $resolver
            ->setDefined('childlogdir')
            ->setAllowedTypes('childlogdir', 'string');

        $resolver
            ->setDefined('user')
            ->setAllowedTypes('user', 'string');

        $resolver
            ->setDefined('directory')
            ->setAllowedTypes('directory', 'string');

        $resolver->setDefined('strip_ansi')
            ->setAllowedTypes('strip_ansi', 'bool');

        $this->configureEnvironmentProperty($resolver);

        $resolver
            ->setDefined('identifier')
            ->setAllowedTypes('identifier', 'string');
    }
}
