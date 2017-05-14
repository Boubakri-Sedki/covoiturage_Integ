<?php

namespace Cv\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CvUserBundle:Default:index.html.twig');
    }
}
