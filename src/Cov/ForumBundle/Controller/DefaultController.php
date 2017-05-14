<?php

namespace Cov\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CovForumBundle:Default:index.html.twig');
    }
}
