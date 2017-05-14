<?php

namespace Cov\DemandeTrajetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CovDemandeTrajetBundle:Default:index.html.twig');
    }
}
