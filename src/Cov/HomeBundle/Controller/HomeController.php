<?php

namespace Cov\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('CovHomeBundle:Default:index.html.twig');
    }
}
