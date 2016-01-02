<?php

namespace Supervisor\Configuration\Section;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\Options;

/**
 * Include section.
 *
 * @link http://supervisord.org/configuration.html#include-section-settings
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Includes extends Base
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'include';

    /**
     * {@inheritdoc}
     */
    protected function configureProperties(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('files')
            ->setAllowedTypes('files', ['string', 'array'])
            ->setNormalizer('files', function (Options $options, $value) {
                return is_string($value) ? $value : implode(' ', $value);
            });
    }
}
