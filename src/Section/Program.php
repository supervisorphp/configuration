<?php

namespace Supervisor\Configuration\Section;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;

/**
 * Program section.
 *
 * @link http://supervisord.org/configuration.html#program-x-section-settings
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Program extends Named
{
    /**
     * {@inheritdoc}
     */
    protected $sectionName = 'program';

    /**
     * {@inheritdoc}
     */
    protected function configureProperties(OptionsResolver $resolver)
    {
        $this->configureProcessProperties($resolver);
        $this->configureStartControlProperties($resolver);
        $this->configureStopControlProperties($resolver);

        $resolver
            ->setDefined('user')
            ->setAllowedTypes('user', 'string');

        $this->configureLogProperties($resolver);

        $this->configureEnvironmentProperty($resolver);

        $resolver
            ->setDefined('directory')
            ->setAllowedTypes('directory', 'string');

        // TODO: octal vs. decimal value
        $resolver->setDefined('umask')
            ->setAllowedTypes('umask', 'integer');

        $resolver
            ->setDefined('serverurl')
            ->setAllowedTypes('serverurl', 'string');
    }

    /**
     * Configures process related properties.
     *
     * @param OptionsResolver $resolver
     */
    private function configureProcessProperties(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('command')
            ->setAllowedTypes('command', 'string');

        $resolver
            ->setDefined('process_name')
            ->setAllowedTypes('process_name', 'string');

        $resolver->setDefined('numprocs')
            ->setAllowedTypes('numprocs', 'integer');

        $resolver->setDefined('numprocs_start')
            ->setAllowedTypes('numprocs_start', 'integer');

        $resolver->setDefined('priority')
            ->setAllowedTypes('priority', 'integer');
    }

    /**
     * Configures start control related properties.
     *
     * @param OptionsResolver $resolver
     */
    private function configureStartControlProperties(OptionsResolver $resolver)
    {
        $resolver->setDefined('autostart')
            ->setAllowedTypes('autostart', 'bool');

        $resolver
            ->setDefined('autorestart')
            ->setAllowedTypes('autorestart', ['bool', 'string'])
            ->setAllowedValues('autorestart', [true, false, 'true', 'false', 'unexpected'])
            ->setNormalizer('autorestart', function (Options $options, $value) {
                return (is_bool($value) or $value === 'unexpected') ? $value : ($value === 'true' ? true : false);
            });

        $resolver->setDefined('startsecs')
            ->setAllowedTypes('startsecs', 'integer');

        $resolver->setDefined('startretries')
            ->setAllowedTypes('startretries', 'integer');
    }

    /**
     * Configures stop control related properties.
     *
     * @param OptionsResolver $resolver
     */
    private function configureStopControlProperties(OptionsResolver $resolver)
    {
        $resolver->setDefined('exitcodes');
        $this->configureArrayProperty('exitcodes', $resolver);

        $resolver
            ->setDefined('stopsignal')
            ->setAllowedTypes('stopsignal', 'string')
            ->setAllowedValues('stopsignal', ['TERM', 'HUP', 'INT', 'QUIT', 'KILL', 'USR1', 'USR2']);

        $resolver->setDefined('stopwaitsecs')
            ->setAllowedTypes('stopwaitsecs', 'integer');

        $resolver->setDefined('stopasgroup')
            ->setAllowedTypes('stopasgroup', 'bool');

        $resolver->setDefined('killasgroup')
            ->setAllowedTypes('killasgroup', 'bool');
    }

    /**
     * Configures log related properties.
     *
     * @param OptionsResolver $resolver
     */
    private function configureLogProperties(OptionsResolver $resolver)
    {
        $resolver->setDefined('redirect_stderr')
            ->setAllowedTypes('redirect_stderr', 'bool');

        $this->configureStdoutLogProperties($resolver);
        $this->configureStderrLogProperties($resolver);
    }

    /**
     * Configures stdout log related properties.
     *
     * @param OptionsResolver $resolver
     */
    private function configureStdoutLogProperties(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined('stdout_logfile')
            ->setAllowedTypes('stdout_logfile', 'string');

        $resolver->setDefined('stdout_logfile_maxbytes');
        $this->configureByteProperty('stdout_logfile_maxbytes', $resolver);

        $resolver->setDefined('stdout_logfile_backups')
            ->setAllowedTypes('stdout_logfile_backups', 'integer');

        $resolver->setDefined('stdout_capture_maxbytes');
        $this->configureByteProperty('stdout_capture_maxbytes', $resolver);

        $resolver->setDefined('stdout_events_enabled')
            ->setAllowedTypes('stdout_events_enabled', 'bool');

        $resolver->setDefined('stdout_syslog')
            ->setAllowedTypes('stdout_syslog', 'bool');
    }

    /**
     * Configures stderr log related properties.
     *
     * @param OptionsResolver $resolver
     */
    private function configureStderrLogProperties(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined('stderr_logfile')
            ->setAllowedTypes('stderr_logfile', 'string');

        $resolver->setDefined('stderr_logfile_maxbytes');
        $this->configureByteProperty('stderr_logfile_maxbytes', $resolver);

        $resolver->setDefined('stderr_logfile_backups')
            ->setAllowedTypes('stderr_logfile_backups', 'integer');

        $resolver->setDefined('stderr_capture_maxbytes');
        $this->configureByteProperty('stderr_capture_maxbytes', $resolver);

        $resolver->setDefined('stderr_events_enabled')
            ->setAllowedTypes('stderr_events_enabled', 'bool');

        $resolver->setDefined('stderr_syslog')
            ->setAllowedTypes('stderr_syslog', 'bool');
    }
}
