<?php

namespace Cov\ChatBundle\Controller;

use Cov\ChatBundle\Entity\Message;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ChatController extends Controller
{
    public function indexAction(Request $request)
    {


        $message = $request->get('q');
        $u2 = $request->get('id2');

        $user = $this->getUser();
        $msg = new Message();
        $msg->setContenu($message);
        $msg->setDateAjout(new \ DateTime());
        $msg->setUser($user);

        $em=$this->getDoctrine()->getManager();
        $user2=$em->getRepository('CovUserBundle:User')->findOneById($u2);
        $msg->setUser2($user2);
        $em=$this->getDoctrine()->getManager();
        if($user != null) {
            $em->persist($msg);
            $em->flush();

        }

        return new Response(json_encode($user));
    }

    public function checkAction(Request $request)
    {
        $message = $request->get('i');
        $id1 = $request->get('id1');
        $id2 = $request->get('id2');
        $em=$this->getDoctrine()->getManager();
        $msg=$em->getRepository('CovChatBundle:Message')
            ->updateMsg($message,$id1,$id2);

        if(!$msg) {
            $result['entities']['error'] = "pas de resultat";
        } else {
            $result['entities'] = $this->getRealEntities($msg);

        }
        return new Response(json_encode($result));

    }

    public function getRealEntities( $entities)
    {
        $i=0;
        $id=0;
        $user=1;
        $datea=2;
        $content=3;
        /* @var $entity \Cov\ChatBundle\Entity\Message */
        foreach ($entities as $entity){

            $realEntities[$i][$id] = $entity->getId();
            $realEntities[$i][$user] = $entity->getUser()->getUsername();
            $realEntities[$i][$datea] = $entity->getDateAjout()->format("d/m/y h:i:s");
            $realEntities[$i][$content] = $entity->getContenu();

            $i++;
        }
        return $realEntities;
    }



}
