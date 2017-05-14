<?php

namespace Cov\TemoignageBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Cov\TemoignageBundle\Entity\Temoignage;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;


class TemoignageController extends Controller
{
    public function indexAction()
    {

        $em=$this->getDoctrine()->getManager();
        $temoignage = $em->getRepository("CovTemoignageBundle:Temoignage")->findBy(array('statut'=>1),
            array('dateValidation'=>'desc'),4,0);

        return $this->render('CovTemoignageBundle:Default:temoignage.html.twig',array('temoignage'=>$temoignage));
    }

    public function ajouterTemoignageAction(Request $request)
    {
        $user = $this->getUser();
        $t = new Temoignage();
        $form=$this->createFormBuilder($t)
        ->add('contenu',TextareaType::class,array('label' => false,
            'attr' => array('placeholder' => 'Temoignage')));
        $form = $form->getForm();
        if ($form->handleRequest($request)->isValid()) {

            $id=$request->get('user');
            $em=$this->getDoctrine()->getManager();
            $user=$em->getRepository('CovUserBundle:User')->find($id);
            $t->setDateAjout(new \DateTime());
            $t->setUser($user);
            $em->persist($t);
            $em->flush();
            $temoignage = $em->getRepository("CovTemoignageBundle:Temoignage")->findBy(array('statut'=>1),
                array('dateValidation'=>'desc'),4,0);

            return $this->render('CovTemoignageBundle:Default:temoignage.html.twig',array('temoignage'=>$temoignage));
        }
        return $this->render('CovTemoignageBundle:Default:addtemoignage.html.twig',
            array('form' => $form->createView(),'user'=>$user));
    }

    public function afficherTemoignageAction(Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $t=$em->getRepository('CovTemoignageBundle:Temoignage')->find($id);

        return $this->render('CovUserBundle:back_office:affichetemoignage.html.twig',array('temoignage'=>$t));
    }

    public function accepterTemoignageAction(Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $t=$em->getRepository('CovTemoignageBundle:Temoignage')
            ->accepterTemoignage($id);
        $t=$em->getRepository('CovTemoignageBundle:Temoignage')->find($id);
        /* @var $entity \Cov\TemoignageBundle\Entity\Temoignage */
        $t->setDateValidation(new \DateTime() );
        $temoignage = $em->getRepository("CovTemoignageBundle:Temoignage")->findAll();


        return $this->redirectToRoute('cov_listtem_admin');
    }

    public function refuserTemoignageAction(Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $t=$em->getRepository('CovTemoignageBundle:Temoignage')
            ->refuserTemoignage($id);



        return $this->redirectToRoute('cov_listtem_admin');
    }
    public function listTemoignageAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $temoignage = $em->getRepository("CovTemoignageBundle:Temoignage")->findAll();
        $f=$temoignage->getId();


        return $this->render('CovUserBundle:back_office:listtemoignage.html.twig', array('temoignage' => $temoignage));

    }

    public function ajaxAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
       // $id=intval($requestString);

        $entities = $em->getRepository("CovTemoignageBundle:Temoignage")
            ->findTemoignage($requestString);
        if(!$entities) {
            $result['entities']['error'] = "Pas de resultat";
        } else {
            $result['entities'] = $this->getRealEntities($entities);

        }
        return new Response(json_encode($result));

    }

    public function getRealEntities( $entities)
    {
        $i=0;
        $id=0;
        $user=1;
        $statut=2;
        $datea=3;
        $datev=4;
        $content=5;
        /* @var $entity \Cov\TemoignageBundle\Entity\Temoignage */
        foreach ($entities as $entity){

            $realEntities[$i][$id] = $entity->getId();
            $realEntities[$i][$user] = $entity->getUser()->getUsername();
            $realEntities[$i][$statut] = $entity->getStatut();
            $realEntities[$i][$datea] = $entity->getDateAjout()->format("d/m/y");
            if($entity->getDateValidation() != null)
            $realEntities[$i][$datev] = $entity->getDateValidation()->format("d/m/y");
            else
                $realEntities[$i][$datev] = $entity->getDateValidation();
            $realEntities[$i][$content] = $entity->getContenu();

                $i++;
        }
        return $realEntities;
    }

    public function getUserTemoignageAction()
    {

        $user = $this->getUser();
        $id=$user->getId();
        $em = $this->getDoctrine()->getManager();
        $temoignage = $em->getRepository("CovTemoignageBundle:Temoignage")->findBy(array('user'=>$user),null,null,null);
        return $this->render('CovTemoignageBundle:Default:usertemoignage.html.twig',array('temoignage'=>$temoignage));

    }

    public function modifierAction(Request $request)
    {
        $user = $this->getUser();

        $em=$this->getDoctrine()->getManager();
        $id=$request->get('id');
        $temoignage = $em->getRepository("CovTemoignageBundle:Temoignage")->findBy(array('id'=>$id),
            null,null,null);

        if ($request->isMethod('post')) {

            $content=$request->get('content');
            $t=$em->getRepository('CovTemoignageBundle:Temoignage')
                ->updateTemoignage($id,$content);
            $temoignage = $em->getRepository("CovTemoignageBundle:Temoignage")->findBy(array('user'=>$user),
                null,null,null);

            return $this->redirectToRoute('cov_listtem_us');

        }
        return $this->render('CovTemoignageBundle:Default:edittemoignage.html.twig',
            array('temoignage'=>$temoignage));
    }

    public function supprimerAction(Request $request)
    {
        $id=$request->get('id');
        $em=$this->getDoctrine()->getManager();
        $t=$em->getRepository('CovTemoignageBundle:Temoignage')->find($id);
        $em->remove($t);
        $em->flush();
        return $this->redirectToRoute('cov_listtem_us');

    }

     public function supprimeraAction(Request $request)
     {
         $id=$request->get('id');
         $em=$this->getDoctrine()->getManager();
         $t=$em->getRepository('CovTemoignageBundle:Temoignage')->find($id);
         $em->remove($t);
         $em->flush();
         return $this->redirectToRoute('cov_listtem_admin');
     }


}
