<?php

namespace Cov\UserBundle\Controller;

use Cov\UserBundle\Entity\Gouvernorat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Gouvernorat controller.
 *
 * @Route("Gouvernorat")
 */
class GouvernoratController extends Controller
{
    /**
     * Lists all gouvernorat entities.
     *
     * @Route("/", name="Gouvernorat_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $gouvernorats = $em->getRepository('CovUserBundle:Gouvernorat')->findAll();

        return $this->render('gouvernorat/index.html.twig', array(
            'gouvernorats' => $gouvernorats,
        ));
    }

    /**
     * Creates a new gouvernorat entity.
     *
     * @Route("/new", name="Gouvernorat_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $gouvernorat = new Gouvernorat();
        $form = $this->createForm('Cov\UserBundle\Form\GouvernoratType', $gouvernorat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($gouvernorat);
            $em->flush($gouvernorat);

            return $this->redirectToRoute('Gouvernorat_show', array('id' => $gouvernorat->getId()));
        }

        return $this->render('gouvernorat/new.html.twig', array(
            'gouvernorat' => $gouvernorat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a gouvernorat entity.
     *
     * @Route("/{id}", name="Gouvernorat_show")
     * @Method("GET")
     */
    public function showAction(Gouvernorat $gouvernorat)
    {
        $deleteForm = $this->createDeleteForm($gouvernorat);

        return $this->render('gouvernorat/show.html.twig', array(
            'gouvernorat' => $gouvernorat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing gouvernorat entity.
     *
     * @Route("/{id}/edit", name="Gouvernorat_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Gouvernorat $gouvernorat)
    {
        $deleteForm = $this->createDeleteForm($gouvernorat);
        $editForm = $this->createForm('Cov\UserBundle\Form\GouvernoratType', $gouvernorat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('Gouvernorat_edit', array('id' => $gouvernorat->getId()));
        }

        return $this->render('gouvernorat/edit.html.twig', array(
            'gouvernorat' => $gouvernorat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a gouvernorat entity.
     *
     * @Route("/{id}", name="Gouvernorat_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Gouvernorat $gouvernorat)
    {
        $form = $this->createDeleteForm($gouvernorat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($gouvernorat);
            $em->flush($gouvernorat);
        }

        return $this->redirectToRoute('Gouvernorat_index');
    }

    /**
     * Creates a form to delete a gouvernorat entity.
     *
     * @param Gouvernorat $gouvernorat The gouvernorat entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Gouvernorat $gouvernorat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('Gouvernorat_delete', array('id' => $gouvernorat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
