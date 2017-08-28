<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HabitacionTipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Habitaciontipo controller.
 *
 * @Route("habitaciontipo")
 */
class HabitacionTipoController extends Controller
{
    /**
     * Lists all habitacionTipo entities.
     *
     * @Route("/", name="habitaciontipo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $habitacionTipos = $em->getRepository('AppBundle:HabitacionTipo')->findAll();

        return $this->render('habitaciontipo/index.html.twig', array(
            'habitacionTipos' => $habitacionTipos,
        ));
    }

    /**
     * Creates a new habitacionTipo entity.
     *
     * @Route("/new", name="habitaciontipo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $habitacionTipo = new Habitaciontipo();
        $form = $this->createForm('AppBundle\Form\HabitacionTipoType', $habitacionTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($habitacionTipo);
            $em->flush();

            return $this->redirectToRoute('habitaciontipo_index');
            //return $this->redirectToRoute('habitaciontipo_show', array('id' => $habitacionTipo->getId()));
        }

        return $this->render('habitaciontipo/new.html.twig', array(
            'habitacionTipo' => $habitacionTipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a habitacionTipo entity.
     *
     * @Route("/{id}", name="habitaciontipo_show")
     * @Method("GET")
     */
    public function showAction(HabitacionTipo $habitacionTipo)
    {
        $deleteForm = $this->createDeleteForm($habitacionTipo);

        return $this->render('habitaciontipo/show.html.twig', array(
            'habitacionTipo' => $habitacionTipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing habitacionTipo entity.
     *
     * @Route("/{id}/edit", name="habitaciontipo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, HabitacionTipo $habitacionTipo)
    {
        $deleteForm = $this->createDeleteForm($habitacionTipo);
        $editForm = $this->createForm('AppBundle\Form\HabitacionTipoType', $habitacionTipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('habitaciontipo_edit', array('id' => $habitacionTipo->getId()));
        }

        return $this->render('habitaciontipo/edit.html.twig', array(
            'habitacionTipo' => $habitacionTipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a habitacionTipo entity.
     *
     * @Route("/{id}", name="habitaciontipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, HabitacionTipo $habitacionTipo)
    {
        $form = $this->createDeleteForm($habitacionTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($habitacionTipo);
            $em->flush();
        }

        return $this->redirectToRoute('habitaciontipo_index');
    }

    /**
     * Creates a form to delete a habitacionTipo entity.
     *
     * @param HabitacionTipo $habitacionTipo The habitacionTipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(HabitacionTipo $habitacionTipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('habitaciontipo_delete', array('id' => $habitacionTipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
