<?php

namespace Cov\EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EvenementController extends Controller
{
    public function indexAction()
    {
        return $this->render('CovEvenementBundle:Default:evenement.html.twig');
    }
}
