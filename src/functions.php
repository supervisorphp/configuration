<?php

/**
 * These functions are in the global namespace, because Symfony Options Resolver only supports is_* functions in the global namespace.
 */
use Supervisor\Configuration\Util;

function is_byte($value)
{
    return Util::isByte($value);
}
