<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GeneroTipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Generotipo controller.
 *
 * @Route("generotipo")
 */
class GeneroTipoController extends Controller
{
    /**
     * Lists all generoTipo entities.
     *
     * @Route("/", name="generotipo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $generoTipos = $em->getRepository('AppBundle:GeneroTipo')->findAll();

        return $this->render('generotipo/index.html.twig', array(
            'generoTipos' => $generoTipos,
        ));
    }

    /**
     * Creates a new generoTipo entity.
     *
     * @Route("/new", name="generotipo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $generoTipo = new Generotipo();
        $form = $this->createForm('AppBundle\Form\GeneroTipoType', $generoTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($generoTipo);
            $em->flush();

            return $this->redirectToRoute('generotipo_index');
            //return $this->redirectToRoute('generotipo_show', array('id' => $generoTipo->getId()));
        }

        return $this->render('generotipo/new.html.twig', array(
            'generoTipo' => $generoTipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a generoTipo entity.
     *
     * @Route("/{id}", name="generotipo_show")
     * @Method("GET")
     */
    public function showAction(GeneroTipo $generoTipo)
    {
        $deleteForm = $this->createDeleteForm($generoTipo);

        return $this->render('generotipo/show.html.twig', array(
            'generoTipo' => $generoTipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing generoTipo entity.
     *
     * @Route("/{id}/edit", name="generotipo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GeneroTipo $generoTipo)
    {
        $deleteForm = $this->createDeleteForm($generoTipo);
        $editForm = $this->createForm('AppBundle\Form\GeneroTipoType', $generoTipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('generotipo_edit', array('id' => $generoTipo->getId()));
        }

        return $this->render('generotipo/edit.html.twig', array(
            'generoTipo' => $generoTipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a generoTipo entity.
     *
     * @Route("/{id}", name="generotipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GeneroTipo $generoTipo)
    {
        $form = $this->createDeleteForm($generoTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($generoTipo);
            $em->flush();
        }

        return $this->redirectToRoute('generotipo_index');
    }

    /**
     * Creates a form to delete a generoTipo entity.
     *
     * @param GeneroTipo $generoTipo The generoTipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GeneroTipo $generoTipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('generotipo_delete', array('id' => $generoTipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
