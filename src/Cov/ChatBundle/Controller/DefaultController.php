<?php

namespace Cov\ChatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cov\ChatBundle\Entity\Message;
use Symfony\Component\HttpFoundation\Request;
class DefaultController extends Controller
{
    public function indexAction()
    {
        $em=$this->getDoctrine()->getManager();
       // $m=$em->getRepository('CovChatBundle:Message')->findMsg();

      //  $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $m=$em->getRepository('CovChatBundle:Message')
            ->findMsgByUsers($user->getId(),2);

        $members = $em->getRepository("CovUserBundle:User")->findAll();

        return $this->render('CovChatBundle:Default:index.html.twig',array('messages'=>$m ,'members'=>$members));
    }

    public function showAction(Request $request)
    {

        $em=$this->getDoctrine()->getManager();
      //  $m=$em->getRepository('CovChatBundle:Message')->fin

        //  $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $id=$request->get('id');
        $id2=$request->get('id2');
        $m=$em->getRepository('CovChatBundle:Message')

           ->findMsgByUsers($user->getId(),$id2);

        $members = $em->getRepository("CovUserBundle:User")->findAll();

        return $this->render('CovChatBundle:Default:index.html.twig',array('messages'=>$m ,'members'=>$members,'idu'=>$id));
    }







}
