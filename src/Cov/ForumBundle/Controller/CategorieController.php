<?php

namespace Cov\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategorieController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

}
