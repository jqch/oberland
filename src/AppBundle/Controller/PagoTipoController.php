<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PagoTipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Pagotipo controller.
 *
 * @Route("pagotipo")
 */
class PagoTipoController extends Controller
{
    /**
     * Lists all pagoTipo entities.
     *
     * @Route("/", name="pagotipo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pagoTipos = $em->getRepository('AppBundle:PagoTipo')->findAll();

        return $this->render('pagotipo/index.html.twig', array(
            'pagoTipos' => $pagoTipos,
        ));
    }

    /**
     * Creates a new pagoTipo entity.
     *
     * @Route("/new", name="pagotipo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $pagoTipo = new Pagotipo();
        $form = $this->createForm('AppBundle\Form\PagoTipoType', $pagoTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($pagoTipo);
            $em->flush();

            return $this->redirectToRoute('pagotipo_index');
            //return $this->redirectToRoute('pagotipo_show', array('id' => $pagoTipo->getId()));
        }

        return $this->render('pagotipo/new.html.twig', array(
            'pagoTipo' => $pagoTipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a pagoTipo entity.
     *
     * @Route("/{id}", name="pagotipo_show")
     * @Method("GET")
     */
    public function showAction(PagoTipo $pagoTipo)
    {
        $deleteForm = $this->createDeleteForm($pagoTipo);

        return $this->render('pagotipo/show.html.twig', array(
            'pagoTipo' => $pagoTipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing pagoTipo entity.
     *
     * @Route("/{id}/edit", name="pagotipo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PagoTipo $pagoTipo)
    {
        $deleteForm = $this->createDeleteForm($pagoTipo);
        $editForm = $this->createForm('AppBundle\Form\PagoTipoType', $pagoTipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pagotipo_edit', array('id' => $pagoTipo->getId()));
        }

        return $this->render('pagotipo/edit.html.twig', array(
            'pagoTipo' => $pagoTipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a pagoTipo entity.
     *
     * @Route("/{id}", name="pagotipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PagoTipo $pagoTipo)
    {
        $form = $this->createDeleteForm($pagoTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($pagoTipo);
            $em->flush();
        }

        return $this->redirectToRoute('pagotipo_index');
    }

    /**
     * Creates a form to delete a pagoTipo entity.
     *
     * @param PagoTipo $pagoTipo The pagoTipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PagoTipo $pagoTipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pagotipo_delete', array('id' => $pagoTipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
