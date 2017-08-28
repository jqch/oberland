<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PaisTipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Paistipo controller.
 *
 * @Route("paistipo")
 */
class PaisTipoController extends Controller
{
    /**
     * Lists all paisTipo entities.
     *
     * @Route("/", name="paistipo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $paisTipos = $em->getRepository('AppBundle:PaisTipo')->findAll();

        return $this->render('paistipo/index.html.twig', array(
            'paisTipos' => $paisTipos,
        ));
    }

    /**
     * Creates a new paisTipo entity.
     *
     * @Route("/new", name="paistipo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $paisTipo = new Paistipo();
        $form = $this->createForm('AppBundle\Form\PaisTipoType', $paisTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($paisTipo);
            $em->flush();

            return $this->redirectToRoute('paistipo_index');
            //return $this->redirectToRoute('paistipo_new', array('id' => $paisTipo->getId()));
        }

        return $this->render('paistipo/new.html.twig', array(
            'paisTipo' => $paisTipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a paisTipo entity.
     *
     * @Route("/{id}", name="paistipo_show")
     * @Method("GET")
     */
    public function showAction(PaisTipo $paisTipo)
    {
        $deleteForm = $this->createDeleteForm($paisTipo);

        return $this->render('paistipo/show.html.twig', array(
            'paisTipo' => $paisTipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing paisTipo entity.
     *
     * @Route("/{id}/edit", name="paistipo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, PaisTipo $paisTipo)
    {
        $deleteForm = $this->createDeleteForm($paisTipo);
        $editForm = $this->createForm('AppBundle\Form\PaisTipoType', $paisTipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('paistipo_edit', array('id' => $paisTipo->getId()));
        }

        return $this->render('paistipo/edit.html.twig', array(
            'paisTipo' => $paisTipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a paisTipo entity.
     *
     * @Route("/{id}", name="paistipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, PaisTipo $paisTipo)
    {
        $form = $this->createDeleteForm($paisTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($paisTipo);
            $em->flush();
        }

        return $this->redirectToRoute('paistipo_index');
    }

    /**
     * Creates a form to delete a paisTipo entity.
     *
     * @param PaisTipo $paisTipo The paisTipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PaisTipo $paisTipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('paistipo_delete', array('id' => $paisTipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
