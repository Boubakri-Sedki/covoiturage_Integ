<?php

namespace Cov\DemandeTrajetBundle\Controller;

use Cov\DemandeTrajetBundle\Entity\DemandeTrajet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Demandetrajet controller.
 *
 */
class DemandeTrajetController extends Controller
{
    /**
     * Lists all demandeTrajet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $demandeTrajets = $em->getRepository('CovDemandeTrajetBundle:DemandeTrajet')->findAll();
        //$demandeTrajets = $demandeTrajetsRepo->setCategory($categoryRepository->find($cat_id));
        /*$repo= $this->getDoctrine()->getRepository('CovDemandeTrajetBundle:DemandeTrajet');
        $query= $repo->createQueryBuilder('t')
            ->select('t.id')->getQuery();
        $demandeTrajets = $query->getResult();*/

        return $this->render('demandetrajet/index.html.twig', array(
            'demandeTrajets' => $demandeTrajets
        ));
    }
    public function chercherAction(Request $request)
    {
        $session = $request->getSession();
        $demandeTrajet= new DemandeTrajet();
        $form = $this->createForm('Cov\DemandeTrajetBundle\Form\DemandeTrajetType', $demandeTrajet);
        $form->handleRequest($request);
        $user = $this->getUser();
        $demandeTrajet->setDateAjout(new \DateTime());
        $demandeTrajet->setUser($user);
        if ($form->isValid()) {
            /*if ($demandeTrajet->getUser()== null)
            {
                $session->getFlashBag()->add('info1', 'vous devez vous connecter!');
                return $this->render('demandetrajet/chercher.html.twig',array('form'=>$form->CreateView()));
            }*/
            $em = $this->getDoctrine()->getManager();
            $em->persist($demandeTrajet);
            $em->flush();
            $session->getFlashBag()->add('info', 'Votre demande a ete envoye en succes!');

        }

        return $this->render('demandetrajet/chercher.html.twig',array('form'=>$form->CreateView()));
        
        
        /*
        $em = $this->getDoctrine()->getManager();

        $demandeTrajets = $em->getRepository('CovDemandeTrajetBundle:DemandeTrajet')->findAll();
        //$demandeTrajets = $demandeTrajetsRepo->setCategory($categoryRepository->find($cat_id));
        /*$repo= $this->getDoctrine()->getRepository('CovDemandeTrajetBundle:DemandeTrajet');
        $query= $repo->createQueryBuilder('t')
            ->select('t.id')->getQuery();
        $demandeTrajets = $query->getResult();

        return $this->render('demandetrajet/chercher.html.twig', array(
            'demandeTrajets' => $demandeTrajets
        ));*/
    }


    public function generateAction()
    {
        $em = $this->getDoctrine()->getManager();

        $demandeTrajets = $em->getRepository('CovDemandeTrajetBundle:DemandeTrajet')->findAll();
        //$demandeTrajets = $demandeTrajetsRepo->setCategory($categoryRepository->find($cat_id));
        /*$repo= $this->getDoctrine()->getRepository('CovDemandeTrajetBundle:DemandeTrajet');
        $query= $repo->createQueryBuilder('t')
            ->select('t.id')->getQuery();
        $demandeTrajets = $query->getResult();*/

        $html = $this->render('demandetrajet/pdf.html.twig', array(
            'demandeTrajets' => $demandeTrajets
        ))->getContent();


        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="projects.pdf"'
            )
        );
    }
    /**
     * Creates a new demandeTrajet entity.
     *
     */
    public function newAction(Request $request)
    {
        $demandeTrajet = new Demandetrajet();
        $form = $this->createForm('Cov\DemandeTrajetBundle\Form\DemandeTrajetType', $demandeTrajet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user=$this->getUser();
            $em=$this->getDoctrine()->getManager();
            $demandeTrajet->setDateAjout(new \DateTime());
            $demandeTrajet->setUser($user);
            if ($demandeTrajet->getDateDemandee())
            $em->persist($demandeTrajet);
            $em->flush($demandeTrajet);

            return $this->redirectToRoute('demandetrajet_show', array('id' => $demandeTrajet->getId()));
        }

        return $this->render('demandetrajet/new.html.twig', array(
            'demandeTrajet' => $demandeTrajet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a demandeTrajet entity.
     *
     */
    public function showAction(DemandeTrajet $demandeTrajet)
    {
        $deleteForm = $this->createDeleteForm($demandeTrajet);

        return $this->render('demandetrajet/show.html.twig', array(
            'demandeTrajet' => $demandeTrajet,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /*public function searchAction()
    {
        $request = $this->getRequest();
        $data = $request->request->get('search');


        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p FROM CovDemandeTrajetBundle:DemandeTrajet p WHERE p.id LIKE :data OR p.nobreDePlace LIKE :data')
            ->setParameter('data', $data);

        $res = $query->getResult();

        return $this->render('demandetrajet:chercher.html.twig', array(
            'res' => $res));
    }*/
    /*public function chercherAction(DemandeTrajet $demandeTrajet)
    {
        $deleteForm = $this->createDeleteForm($demandeTrajet);

        return $this->render('demandetrajet/chercher.html.twig', array(
            'demandeTrajet' => $demandeTrajet,
            'delete_form' => $deleteForm->createView(),
        ));
    }*/
    /*public function searchAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        // $id=intval($requestString);

        $entities = $em->getRepository("CovDemandeTrajetBundle:DemandeTrajet")
            ->findDemandTrajet($requestString);
        if(!$entities) {
            $result['entities']['error'] = "keine Einträge gefunden";
        } else {
            $result['entities'] = $this->getRealEntities($entities);

        }
        return new Response(json_encode($result));

    }*/

    /**
     * Displays a form to edit an existing demandeTrajet entity.
     *
     */
    public function editAction(Request $request, DemandeTrajet $demandeTrajet)
    {
        $deleteForm = $this->createDeleteForm($demandeTrajet);
        $editForm = $this->createForm('Cov\DemandeTrajetBundle\Form\DemandeTrajetType', $demandeTrajet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('demandetrajet_edit', array('id' => $demandeTrajet->getId()));
        }

        return $this->render('demandetrajet/edit.html.twig', array(
            'demandeTrajet' => $demandeTrajet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a demandeTrajet entity.
     *
     */
    public function deleteAction(Request $request, DemandeTrajet $demandeTrajet)
    {
        $form = $this->createDeleteForm($demandeTrajet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demandeTrajet);
            $em->flush($demandeTrajet);
        }

        return $this->redirectToRoute('demandetrajet_index');
    }
    /*public function chercherAction($key)
    {
        $form = $this->createDeleteForm($demandeTrajet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($demandeTrajet);
            $em->flush($demandeTrajet);
        }

        return $this->redirectToRoute('demandetrajet_index');
    }*/

    /**
     * Creates a form to delete a demandeTrajet entity.
     *
     * @param DemandeTrajet $demandeTrajet The demandeTrajet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DemandeTrajet $demandeTrajet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('demandetrajet_delete', array('id' => $demandeTrajet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
