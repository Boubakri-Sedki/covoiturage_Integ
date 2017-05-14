<?php

namespace Cov\TemoignageBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TemoignageController extends Controller
{
    public function indexAction()
    {


        return $this->render('CovTemoignageBundle:Default:temoignage.html.twig');
    }

    public function ajouterTemoignageAction()
    {



        return $this->render('CovTemoignageBundle:Default:addtemoignage.html.twig');
    }
}
