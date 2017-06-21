<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Habitacion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Habitacion controller.
 *
 * @Route("habitacion")
 */
class HabitacionController extends Controller
{
    /**
     * Lists all habitacion entities.
     *
     * @Route("/", name="habitacion_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $habitacions = $em->getRepository('AppBundle:Habitacion')->findAll();

        return $this->render('habitacion/index.html.twig', array(
            'habitacions' => $habitacions,
        ));
    }

    /**
     * Creates a new habitacion entity.
     *
     * @Route("/new", name="habitacion_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $habitacion = new Habitacion();
        $form = $this->createForm('AppBundle\Form\HabitacionType', $habitacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($habitacion);
            $em->flush();

            return $this->redirectToRoute('habitacion_show', array('id' => $habitacion->getId()));
        }

        return $this->render('habitacion/new.html.twig', array(
            'habitacion' => $habitacion,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a habitacion entity.
     *
     * @Route("/{id}", name="habitacion_show")
     * @Method("GET")
     */
    public function showAction(Habitacion $habitacion)
    {
        $deleteForm = $this->createDeleteForm($habitacion);

        return $this->render('habitacion/show.html.twig', array(
            'habitacion' => $habitacion,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing habitacion entity.
     *
     * @Route("/{id}/edit", name="habitacion_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Habitacion $habitacion)
    {
        $deleteForm = $this->createDeleteForm($habitacion);
        $editForm = $this->createForm('AppBundle\Form\HabitacionType', $habitacion);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('habitacion_edit', array('id' => $habitacion->getId()));
        }

        return $this->render('habitacion/edit.html.twig', array(
            'habitacion' => $habitacion,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a habitacion entity.
     *
     * @Route("/{id}", name="habitacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Habitacion $habitacion)
    {
        $form = $this->createDeleteForm($habitacion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($habitacion);
            $em->flush();
        }

        return $this->redirectToRoute('habitacion_index');
    }

    /**
     * Creates a form to delete a habitacion entity.
     *
     * @param Habitacion $habitacion The habitacion entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Habitacion $habitacion)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('habitacion_delete', array('id' => $habitacion->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
