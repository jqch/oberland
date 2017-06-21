<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ReservaServicio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reservaservicio controller.
 *
 * @Route("reservaservicio")
 */
class ReservaServicioController extends Controller
{
    /**
     * Lists all reservaServicio entities.
     *
     * @Route("/", name="reservaservicio_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservaServicios = $em->getRepository('AppBundle:ReservaServicio')->findAll();

        return $this->render('reservaservicio/index.html.twig', array(
            'reservaServicios' => $reservaServicios,
        ));
    }

    /**
     * Creates a new reservaServicio entity.
     *
     * @Route("/new", name="reservaservicio_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reservaServicio = new Reservaservicio();
        $form = $this->createForm('AppBundle\Form\ReservaServicioType', $reservaServicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reservaServicio);
            $em->flush();

            return $this->redirectToRoute('reservaservicio_show', array('id' => $reservaServicio->getId()));
        }

        return $this->render('reservaservicio/new.html.twig', array(
            'reservaServicio' => $reservaServicio,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservaServicio entity.
     *
     * @Route("/{id}", name="reservaservicio_show")
     * @Method("GET")
     */
    public function showAction(ReservaServicio $reservaServicio)
    {
        $deleteForm = $this->createDeleteForm($reservaServicio);

        return $this->render('reservaservicio/show.html.twig', array(
            'reservaServicio' => $reservaServicio,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reservaServicio entity.
     *
     * @Route("/{id}/edit", name="reservaservicio_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ReservaServicio $reservaServicio)
    {
        $deleteForm = $this->createDeleteForm($reservaServicio);
        $editForm = $this->createForm('AppBundle\Form\ReservaServicioType', $reservaServicio);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservaservicio_edit', array('id' => $reservaServicio->getId()));
        }

        return $this->render('reservaservicio/edit.html.twig', array(
            'reservaServicio' => $reservaServicio,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservaServicio entity.
     *
     * @Route("/{id}", name="reservaservicio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ReservaServicio $reservaServicio)
    {
        $form = $this->createDeleteForm($reservaServicio);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservaServicio);
            $em->flush();
        }

        return $this->redirectToRoute('reservaservicio_index');
    }

    /**
     * Creates a form to delete a reservaServicio entity.
     *
     * @param ReservaServicio $reservaServicio The reservaServicio entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReservaServicio $reservaServicio)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservaservicio_delete', array('id' => $reservaServicio->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
