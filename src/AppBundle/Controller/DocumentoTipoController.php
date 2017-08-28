<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DocumentoTipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Documentotipo controller.
 *
 * @Route("documentotipo")
 */
class DocumentoTipoController extends Controller
{
    /**
     * Lists all documentoTipo entities.
     *
     * @Route("/", name="documentotipo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documentoTipos = $em->getRepository('AppBundle:DocumentoTipo')->findAll();

        return $this->render('documentotipo/index.html.twig', array(
            'documentoTipos' => $documentoTipos,
        ));
    }

    /**
     * Creates a new documentoTipo entity.
     *
     * @Route("/new", name="documentotipo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $documentoTipo = new Documentotipo();
        $form = $this->createForm('AppBundle\Form\DocumentoTipoType', $documentoTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($documentoTipo);
            $em->flush();

            return $this->redirectToRoute('documentotipo_index');
            //return $this->redirectToRoute('documentotipo_show', array('id' => $documentoTipo->getId()));
        }

        return $this->render('documentotipo/new.html.twig', array(
            'documentoTipo' => $documentoTipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a documentoTipo entity.
     *
     * @Route("/{id}", name="documentotipo_show")
     * @Method("GET")
     */
    public function showAction(DocumentoTipo $documentoTipo)
    {
        $deleteForm = $this->createDeleteForm($documentoTipo);

        return $this->render('documentotipo/show.html.twig', array(
            'documentoTipo' => $documentoTipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing documentoTipo entity.
     *
     * @Route("/{id}/edit", name="documentotipo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DocumentoTipo $documentoTipo)
    {
        $deleteForm = $this->createDeleteForm($documentoTipo);
        $editForm = $this->createForm('AppBundle\Form\DocumentoTipoType', $documentoTipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('documentotipo_edit', array('id' => $documentoTipo->getId()));
        }

        return $this->render('documentotipo/edit.html.twig', array(
            'documentoTipo' => $documentoTipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a documentoTipo entity.
     *
     * @Route("/{id}", name="documentotipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DocumentoTipo $documentoTipo)
    {
        $form = $this->createDeleteForm($documentoTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($documentoTipo);
            $em->flush();
        }

        return $this->redirectToRoute('documentotipo_index');
    }

    /**
     * Creates a form to delete a documentoTipo entity.
     *
     * @param DocumentoTipo $documentoTipo The documentoTipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DocumentoTipo $documentoTipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('documentotipo_delete', array('id' => $documentoTipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
