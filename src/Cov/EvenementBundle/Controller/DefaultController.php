<?php

namespace Cov\EvenementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CovEvenementBundle:Default:index.html.twig');
    }
}
