<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PisoTipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pisotipo controller.
 *
 * @Route("pisotipo")
 */
class PisoTipoController extends Controller
{
    /**
     * Lists all pisoTipo entities.
     *
     * @Route("/", name="pisotipo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pisoTipos = $em->getRepository('AppBundle:PisoTipo')->findAll();

        return $this->render('pisotipo/index.html.twig', array(
            'pisoTipos' => $pisoTipos,
        ));
    }

    /**
     * Creates a new pisoTipo entity.
     *
     * @Route("/new", name="pisotipo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pisoTipo = new Pisotipo();
        $form = $this->createForm('AppBundle\Form\PisoTipoType', $pisoTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pisoTipo);
            $em->flush();

            return $this->redirectToRoute('pisotipo_index');
            //return $this->redirectToRoute('pisotipo_show', array('id' => $pisoTipo->getId()));
        }

        return $this->render('pisotipo/new.html.twig', array(
            'pisoTipo' => $pisoTipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pisoTipo entity.
     *
     * @Route("/{id}", name="pisotipo_show")
     * @Method("GET")
     */
    public function showAction(PisoTipo $pisoTipo)
    {
        $deleteForm = $this->createDeleteForm($pisoTipo);

        return $this->render('pisotipo/show.html.twig', array(
            'pisoTipo' => $pisoTipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pisoTipo entity.
     *
     * @Route("/{id}/edit", name="pisotipo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PisoTipo $pisoTipo)
    {
        $deleteForm = $this->createDeleteForm($pisoTipo);
        $editForm = $this->createForm('AppBundle\Form\PisoTipoType', $pisoTipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pisotipo_edit', array('id' => $pisoTipo->getId()));
        }

        return $this->render('pisotipo/edit.html.twig', array(
            'pisoTipo' => $pisoTipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pisoTipo entity.
     *
     * @Route("/{id}", name="pisotipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PisoTipo $pisoTipo)
    {
        $form = $this->createDeleteForm($pisoTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pisoTipo);
            $em->flush();
        }

        return $this->redirectToRoute('pisotipo_index');
    }

    /**
     * Creates a form to delete a pisoTipo entity.
     *
     * @param PisoTipo $pisoTipo The pisoTipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PisoTipo $pisoTipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pisotipo_delete', array('id' => $pisoTipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
