<?php

namespace Cov\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CovUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
