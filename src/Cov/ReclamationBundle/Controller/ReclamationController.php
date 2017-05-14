<?php

namespace Cov\ReclamationBundle\Controller;

use Cov\ReclamationBundle\Entity\Reclamation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reclamation controller.
 *
 * @Route("reclamation")
 */
class ReclamationController extends Controller
{
    /**
     * Lists all reclamation entities.
     *
     * @Route("/", name="reclamation_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('CovReclamationBundle:Reclamation')->findBy(array('user'=>$this->getUser()));


        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator=$this->get('knp_paginator');
        $result= $paginator->paginate(
            $reclamations,
            $request->query->getInt('page',1),
            $request->query->getInt('limit',7)
        );



        return $this->render('reclamation/show_user.html.twig', array(
            'reclamations' => $result,
        ));
    }
    public function index_adminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reclamations = $em->getRepository('CovReclamationBundle:Reclamation')->findAll();
        //CovReclamationBundle:Default:contact.html.twig
        return $this->render('reclamation/index.html.twig', array(
            'reclamations' => $reclamations,
        ));
    }

    /**
     * Creates a new reclamation entity.
     *
     * @Route("/new", name="reclamation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $reclamation = new Reclamation();
        $form = $this->createForm('Cov\ReclamationBundle\Form\ReclamationType', $reclamation);
        $form->handleRequest($request);
        $user = $this->getUser();
     //   $userconn = $this->container->get('security.token_storage')->getToken()->getUser();
            $reclamation->setUser($user);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reclamation);
            $em->flush();

            return $this->redirectToRoute('cov_reclamation_homepage');
        }

        return $this->render('reclamation/new.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reclamation entity.
     *
     * @Route("/{id}", name="reclamation_show")
     * @Method("GET")
     */
    public function showUserAction(Reclamation $reclamation)
    {
        $deleteForm = $this->createDeleteForm($reclamation);

        return $this->render('reclamation/show.html.twig', array(
            'reclamation' => $reclamation,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function showAction(Reclamation $reclamation)
    {
        $deleteForm = $this->createDeleteForm($reclamation);

        return $this->render('CovUserBundle:back_office:reclamation_show.html.twig', array(
            'reclamation' => $reclamation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reclamation entity.
     *
     * @Route("/{id}/edit", name="reclamation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reclamation $reclamation)
    {
        $deleteForm = $this->createDeleteForm($reclamation);
        $editForm = $this->createForm('Cov\ReclamationBundle\Form\ReclamationType', $reclamation);
        $editForm->handleRequest($request);
        $userconn = $this->container->get('security.token_storage')->getToken()->getUser();
        $reclamation->setUser($userconn);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reclamation_edit', array('id' => $reclamation->getId()));
        }

        return $this->render('reclamation/edit.html.twig', array(
            'reclamation' => $reclamation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    public function traiteAction(Reclamation $reclamation)
    {

        $userconn = $this->container->get('security.token_storage')->getToken()->getUser();
        $user = $this->getUser();
        $reclamation->setUser($userconn);
        $reclamation->setStatut(1);
        $reclamation->setDateTraite(new \DateTime("today"));
        $this->getDoctrine()->getManager()->flush();

        return $this->render('reclamation/index.html.twig', array(
            'reclamation' => $reclamation,
        ));
    }

    public function showReclamationAction(Reclamation $reclamation)
    {

        $deleteForm = $this->createDeleteForm($reclamation);

        return $this->render('CovUserBundle:back_office:reclamation_show.html.twig', array(
            'reclamation' => $reclamation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function showReclamationnAction(Request $request)
    {

        $id=$request->get('id');
        $em = $this->getDoctrine()->getManager();

        $reclamation = $em->getRepository('CovReclamationBundle:Reclamation')->find($id);



        $deleteForm = $this->createDeleteForm($reclamation);

        return $this->render('CovUserBundle:back_office:reclamation_show.html.twig', array(
            'reclamation' => $reclamation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function TraiteReclamationAction(Reclamation $reclamation)
    {

        $reclamation->setStatut(1);
        $em=$this->getDoctrine()->getManager();
        $em->persist($reclamation);
        $em->flush();

        return $this->render('back_office/Reclamation.html.twig', array(
            'reclamation' => $reclamation,
        ));
    }

    /**
     * Deletes a reclamation entity.
     *
     * @Route("/{id}", name="reclamation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reclamation $reclamation)
    {
        $form = $this->createDeleteForm($reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reclamation);
            $em->flush();
        }

        return $this->redirectToRoute('reclamation_index');
    }

    /**
     * Creates a form to delete a reclamation entity.
     *
     * @param Reclamation $reclamation The reclamation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reclamation $reclamation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reclamation_delete', array('id' => $reclamation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $reclamation =  $em->getRepository('AppBundle:Entity')->findEntitiesByString($requestString);
        if(!$reclamation) {
            $result['entities']['error'] = "Pas de Résultat Trouvé";
        } else {
            $result['entities'] = $this->getRealEntities($reclamation);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($reclamation){
        foreach ($reclamation as $entity){
            $realEntities[$entity->getId()] = $entity->getFoo();
        }
        return $realEntities;
    }
}
