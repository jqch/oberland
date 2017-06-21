<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ServicioTipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Serviciotipo controller.
 *
 * @Route("serviciotipo")
 */
class ServicioTipoController extends Controller
{
    /**
     * Lists all servicioTipo entities.
     *
     * @Route("/", name="serviciotipo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $servicioTipos = $em->getRepository('AppBundle:ServicioTipo')->findAll();

        return $this->render('serviciotipo/index.html.twig', array(
            'servicioTipos' => $servicioTipos,
        ));
    }

    /**
     * Creates a new servicioTipo entity.
     *
     * @Route("/new", name="serviciotipo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $servicioTipo = new Serviciotipo();
        $form = $this->createForm('AppBundle\Form\ServicioTipoType', $servicioTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($servicioTipo);
            $em->flush();

            return $this->redirectToRoute('serviciotipo_show', array('id' => $servicioTipo->getId()));
        }

        return $this->render('serviciotipo/new.html.twig', array(
            'servicioTipo' => $servicioTipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a servicioTipo entity.
     *
     * @Route("/{id}", name="serviciotipo_show")
     * @Method("GET")
     */
    public function showAction(ServicioTipo $servicioTipo)
    {
        $deleteForm = $this->createDeleteForm($servicioTipo);

        return $this->render('serviciotipo/show.html.twig', array(
            'servicioTipo' => $servicioTipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing servicioTipo entity.
     *
     * @Route("/{id}/edit", name="serviciotipo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ServicioTipo $servicioTipo)
    {
        $deleteForm = $this->createDeleteForm($servicioTipo);
        $editForm = $this->createForm('AppBundle\Form\ServicioTipoType', $servicioTipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('serviciotipo_edit', array('id' => $servicioTipo->getId()));
        }

        return $this->render('serviciotipo/edit.html.twig', array(
            'servicioTipo' => $servicioTipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a servicioTipo entity.
     *
     * @Route("/{id}", name="serviciotipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ServicioTipo $servicioTipo)
    {
        $form = $this->createDeleteForm($servicioTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($servicioTipo);
            $em->flush();
        }

        return $this->redirectToRoute('serviciotipo_index');
    }

    /**
     * Creates a form to delete a servicioTipo entity.
     *
     * @param ServicioTipo $servicioTipo The servicioTipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ServicioTipo $servicioTipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('serviciotipo_delete', array('id' => $servicioTipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
