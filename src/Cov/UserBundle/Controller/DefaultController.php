<?php

namespace Cov\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Cov\UserBundle\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Cov\TemoignageBundle\Entity\Temoignage;
use Cov\TemoignageBundle\Entity\TemoignageRepository;


class DefaultController extends Controller
{



    public function indexAction()
    {
        return $this->render('CovUserBundle:Default:index.html.twig');
    }

    public function adminAction()
    {
        return $this->render('CovUserBundle:back_office:layout.html.twig');
    }

    public function listMembersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $members = $em->getRepository("CovUserBundle:User")->findAll();
        return $this->render('CovUserBundle:back_office:listmembers.html.twig', array('members' => $members));
    }

    public function viewProfileAction(Request $request)
    {

        $id=$request->get('id');
        $em = $this->getDoctrine()->getManager();
        $member = $em->getRepository("CovUserBundle:User")->findBy(array('id'=>$id),null,null,null);

        return $this->render('CovUserBundle:back_office:memberProfile.html.twig', array('member' => $member));

    }

    public function listTemoignageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $temoignage = $em->getRepository("CovTemoignageBundle:Temoignage")->findAll();
        if($request->isMethod('post')) {

            $da1 = $request->get('da1');
            $da2 = $request->get('da2');
            $dv1 = $request->get('dv1');
            $dv2 = $request->get('dv2');
            $st=$request->get('st');
            if ($da1 == null) {

                $da1 = new \DateTime('08-02-2000 00:00:00');

            }
            else
                $da1 = new \DateTime($da1 . " 00:00:00");
            if($da2 == null)
            {
                $da2= new \DateTime('08-02-2030 00:00:00');
            }
            else
                $da2 = new \DateTime($da2 . " 23:59:59");
            if($dv1 == null)
            {
                $dv1 = new \DateTime('08-02-2000 00:00:00');

            }
            else
                $dv1 = new \DateTime($dv1 . " 00:00:00");
            if($dv2 == null)
            {
                $dv2= new \DateTime('08-02-2030 00:00:00');
            }
            else
                $dv2 = new \DateTime($dv2 . " 23:59:59");

                $temoignage = $em->getRepository("CovTemoignageBundle:Temoignage")
                    ->rechercherTemoignage($da1,$da2,$dv1,$dv2,$st);

        }





        return $this->render('CovUserBundle:back_office:listtemoignage.html.twig', array('temoignage' => $temoignage));

    }


    public function viewtableAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('CovReclamationBundle:Reclamation')->findAll();

        return $this->render('CovUserBundle:back_office:Reclamation.html.twig', array(
            'reclamations' => $reclamations,
        ));
    }
    public function TraiteReclamationAction($id)
    {

        $em=$this->getDoctrine()->getManager();
        $reclamation = $em->getRepository('CovReclamationBundle:Reclamation')->find($id);
        $reclamation->setStatut(1);
        $reclamation->setDateTraite(new \DateTime());
        $em->flush();


        return $this->redirectToRoute('cov_view_reclamation');
    }




}
