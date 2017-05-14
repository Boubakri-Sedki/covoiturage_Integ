<?php

namespace Cov\AnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CovAnnonceBundle:Default:rides.html.twig');
    }
}
