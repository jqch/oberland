<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ReservaEstadoTipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reservaestadotipo controller.
 *
 * @Route("reservaestadotipo")
 */
class ReservaEstadoTipoController extends Controller
{
    /**
     * Lists all reservaEstadoTipo entities.
     *
     * @Route("/", name="reservaestadotipo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservaEstadoTipos = $em->getRepository('AppBundle:ReservaEstadoTipo')->findAll();

        return $this->render('reservaestadotipo/index.html.twig', array(
            'reservaEstadoTipos' => $reservaEstadoTipos,
        ));
    }

    /**
     * Creates a new reservaEstadoTipo entity.
     *
     * @Route("/new", name="reservaestadotipo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reservaEstadoTipo = new Reservaestadotipo();
        $form = $this->createForm('AppBundle\Form\ReservaEstadoTipoType', $reservaEstadoTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservaEstadoTipo);
            $em->flush();

            return $this->redirectToRoute('reservaestadotipo_show', array('id' => $reservaEstadoTipo->getId()));
        }

        return $this->render('reservaestadotipo/new.html.twig', array(
            'reservaEstadoTipo' => $reservaEstadoTipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservaEstadoTipo entity.
     *
     * @Route("/{id}", name="reservaestadotipo_show")
     * @Method("GET")
     */
    public function showAction(ReservaEstadoTipo $reservaEstadoTipo)
    {
        $deleteForm = $this->createDeleteForm($reservaEstadoTipo);

        return $this->render('reservaestadotipo/show.html.twig', array(
            'reservaEstadoTipo' => $reservaEstadoTipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reservaEstadoTipo entity.
     *
     * @Route("/{id}/edit", name="reservaestadotipo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ReservaEstadoTipo $reservaEstadoTipo)
    {
        $deleteForm = $this->createDeleteForm($reservaEstadoTipo);
        $editForm = $this->createForm('AppBundle\Form\ReservaEstadoTipoType', $reservaEstadoTipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservaestadotipo_edit', array('id' => $reservaEstadoTipo->getId()));
        }

        return $this->render('reservaestadotipo/edit.html.twig', array(
            'reservaEstadoTipo' => $reservaEstadoTipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservaEstadoTipo entity.
     *
     * @Route("/{id}", name="reservaestadotipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ReservaEstadoTipo $reservaEstadoTipo)
    {
        $form = $this->createDeleteForm($reservaEstadoTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservaEstadoTipo);
            $em->flush();
        }

        return $this->redirectToRoute('reservaestadotipo_index');
    }

    /**
     * Creates a form to delete a reservaEstadoTipo entity.
     *
     * @param ReservaEstadoTipo $reservaEstadoTipo The reservaEstadoTipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReservaEstadoTipo $reservaEstadoTipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservaestadotipo_delete', array('id' => $reservaEstadoTipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
