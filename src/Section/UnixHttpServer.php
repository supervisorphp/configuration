<?php

namespace Supervisor\Configuration\Section;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Unix HTTP section.
 *
 * @link http://supervisord.org/configuration.html#unix-http-server-section-settings
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class UnixHttpServer extends Base
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'unix_http_server';

    /**
     * {@inheritdoc}
     */
    protected function configureProperties(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined('file')
            ->setAllowedTypes('file', 'string');

        // TODO: octal vs. decimal value
        $resolver->setDefined('chmod')
            ->setAllowedTypes('chmod', 'integer');

        $resolver
            ->setDefined('chown')
            ->setAllowedTypes('chown', 'string');

        $resolver
            ->setDefined('username')
            ->setAllowedTypes('username', 'string');

        $resolver
            ->setDefined('password')
            ->setAllowedTypes('password', 'string');
    }
}
