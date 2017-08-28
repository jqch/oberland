<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ResidenciaTipo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Residenciatipo controller.
 *
 * @Route("residenciatipo")
 */
class ResidenciaTipoController extends Controller
{
    /**
     * Lists all residenciaTipo entities.
     *
     * @Route("/", name="residenciatipo_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $residenciaTipos = $em->getRepository('AppBundle:ResidenciaTipo')->findAll();

        return $this->render('residenciatipo/index.html.twig', array(
            'residenciaTipos' => $residenciaTipos,
        ));
    }

    /**
     * Creates a new residenciaTipo entity.
     *
     * @Route("/new", name="residenciatipo_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $residenciaTipo = new Residenciatipo();
        $form = $this->createForm('AppBundle\Form\ResidenciaTipoType', $residenciaTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($residenciaTipo);
            $em->flush();

            return $this->redirectToRoute('residenciatipo_index');
            //return $this->redirectToRoute('residenciatipo_show', array('id' => $residenciaTipo->getId()));
        }

        return $this->render('residenciatipo/new.html.twig', array(
            'residenciaTipo' => $residenciaTipo,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a residenciaTipo entity.
     *
     * @Route("/{id}", name="residenciatipo_show")
     * @Method("GET")
     */
    public function showAction(ResidenciaTipo $residenciaTipo)
    {
        $deleteForm = $this->createDeleteForm($residenciaTipo);

        return $this->render('residenciatipo/show.html.twig', array(
            'residenciaTipo' => $residenciaTipo,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing residenciaTipo entity.
     *
     * @Route("/{id}/edit", name="residenciatipo_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ResidenciaTipo $residenciaTipo)
    {
        $deleteForm = $this->createDeleteForm($residenciaTipo);
        $editForm = $this->createForm('AppBundle\Form\ResidenciaTipoType', $residenciaTipo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('residenciatipo_edit', array('id' => $residenciaTipo->getId()));
        }

        return $this->render('residenciatipo/edit.html.twig', array(
            'residenciaTipo' => $residenciaTipo,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a residenciaTipo entity.
     *
     * @Route("/{id}", name="residenciatipo_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ResidenciaTipo $residenciaTipo)
    {
        $form = $this->createDeleteForm($residenciaTipo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($residenciaTipo);
            $em->flush();
        }

        return $this->redirectToRoute('residenciatipo_index');
    }

    /**
     * Creates a form to delete a residenciaTipo entity.
     *
     * @param ResidenciaTipo $residenciaTipo The residenciaTipo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ResidenciaTipo $residenciaTipo)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('residenciatipo_delete', array('id' => $residenciaTipo->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
