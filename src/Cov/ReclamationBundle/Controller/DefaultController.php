<?php

namespace Cov\ReclamationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CovReclamationBundle:Default:index.html.twig');
    }
}
