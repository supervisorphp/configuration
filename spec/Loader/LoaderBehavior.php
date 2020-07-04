<?php

namespace spec\Supervisor\Configuration\Loader;

use Supervisor\Configuration\Loader\LoaderInterface;

trait LoaderBehavior
{
    function it_is_a_loader()
    {
        $this->shouldImplement(LoaderInterface::class);
    }
}
