<?php

namespace Cov\AnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AnnonceController extends Controller
{
    public function indexAction()
    {
        return $this->render('CovAnnonceBundle:Default:rides.html.twig');
    }

    public function ajoutAction()
    {
        return $this->render('CovAnnonceBundle:Default:addRide.html.twig');
    }


}
