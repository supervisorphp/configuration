<?php

/*
 * This file is part of the Supervisor Configuration package.
 *
 * (c) Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Supervisor\Stub;

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
