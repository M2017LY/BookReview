<?php

namespace Book\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class BookUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
