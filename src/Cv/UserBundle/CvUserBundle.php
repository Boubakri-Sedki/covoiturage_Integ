<?php

namespace Cv\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CvUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
