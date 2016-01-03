<?php

namespace Supervisor\Configuration\Stub;

use Supervisor\Configuration\Section\Base;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Section Stub
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Section extends Base
{
    /**
     * {@inheritdoc}
     */
    protected $name = 'test';

    /**
     * {@inheritdoc}
     */
    protected function configureProperties(OptionsResolver $resolver)
    {
        $resolver
            ->setDefined('key')
            ->setAllowedTypes('key', 'string');

        $this->configureEnvironmentProperty($resolver);
    }
}
