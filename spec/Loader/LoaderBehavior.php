<?php

namespace spec\Supervisor\Configuration\Loader;

trait LoaderBehavior
{
    function it_is_a_loader()
    {
        $this->shouldImplement('Supervisor\Configuration\Loader');
    }
}
