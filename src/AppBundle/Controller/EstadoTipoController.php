<?php

namespace AppBundle\Controller;

use AppBundle\Entity\EstadoTipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Estadotipo controller.
 *
 * @Route("estadotipo")
 */
class EstadoTipoController extends Controller
{
    /**
     * Lists all estadoTipo entities.
     *
     * @Route("/", name="estadotipo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $estadoTipos = $em->getRepository('AppBundle:EstadoTipo')->findAll();

        return $this->render('estadotipo/index.html.twig', array(
            'estadoTipos' => $estadoTipos,
        ));
    }

    /**
     * Creates a new estadoTipo entity.
     *
     * @Route("/new", name="estadotipo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $estadoTipo = new Estadotipo();
        $form = $this->createForm('AppBundle\Form\EstadoTipoType', $estadoTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($estadoTipo);
            $em->flush();

            return $this->redirectToRoute('estadotipo_index');
            //return $this->redirectToRoute('estadotipo_show', array('id' => $estadoTipo->getId()));
        }

        return $this->render('estadotipo/new.html.twig', array(
            'estadoTipo' => $estadoTipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a estadoTipo entity.
     *
     * @Route("/{id}", name="estadotipo_show")
     * @Method("GET")
     */
    public function showAction(EstadoTipo $estadoTipo)
    {
        $deleteForm = $this->createDeleteForm($estadoTipo);

        return $this->render('estadotipo/show.html.twig', array(
            'estadoTipo' => $estadoTipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing estadoTipo entity.
     *
     * @Route("/{id}/edit", name="estadotipo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, EstadoTipo $estadoTipo)
    {
        $deleteForm = $this->createDeleteForm($estadoTipo);
        $editForm = $this->createForm('AppBundle\Form\EstadoTipoType', $estadoTipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('estadotipo_edit', array('id' => $estadoTipo->getId()));
        }

        return $this->render('estadotipo/edit.html.twig', array(
            'estadoTipo' => $estadoTipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a estadoTipo entity.
     *
     * @Route("/{id}", name="estadotipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, EstadoTipo $estadoTipo)
    {
        $form = $this->createDeleteForm($estadoTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($estadoTipo);
            $em->flush();
        }

        return $this->redirectToRoute('estadotipo_index');
    }

    /**
     * Creates a form to delete a estadoTipo entity.
     *
     * @param EstadoTipo $estadoTipo The estadoTipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(EstadoTipo $estadoTipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('estadotipo_delete', array('id' => $estadoTipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
