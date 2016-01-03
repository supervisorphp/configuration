<?php

namespace Supervisor\Configuration\Section;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;

/**
 * Inet HTTP Server section.
 *
 * @link http://supervisord.org/configuration.html#inet-http-server-section-settings
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class InetHttpServer extends Base
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'inet_http_server';

    /**
     * {@inheritdoc}
     */
    protected function configureProperties(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('port')
            ->setAllowedTypes('port', ['integer', 'string'])
            ->setNormalizer('port', function (Options $options, $value) {
                // We cast it to integer first to make sure it is an integer representation
                is_numeric($value) and $value = '*:'.intval($value);

                return $value;
            });

        $resolver
            ->setDefined('username')
            ->setAllowedTypes('username', 'string');

        $resolver
            ->setDefined('password')
            ->setAllowedTypes('password', 'string');
    }
}
