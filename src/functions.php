<?php

/*
 * This file is part of the Supervisor Configuration package.
 *
 * (c) Márk Sági-Kazár <mark.sagikazar@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * These functions are in the global namespace, because Symfony Options Resolver only supports is_* functions in the global namespace.
 */
use Supervisor\Configuration\Util;

function is_byte($value)
{
    return Util::isByte($value);
}
