<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Huesped;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Huesped controller.
 *
 * @Route("huesped")
 */
class HuespedController extends Controller
{
    /**
     * Lists all huesped entities.
     *
     * @Route("/", name="huesped_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $huespeds = $em->getRepository('AppBundle:Huesped')->findAll();

        return $this->render('huesped/index.html.twig', array(
            'huespeds' => $huespeds,
        ));
    }

    /**
     * Creates a new huesped entity.
     *
     * @Route("/new", name="huesped_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $huesped = new Huesped();
        $form = $this->createForm('AppBundle\Form\HuespedType', $huesped);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $file = $huesped->getFotografia();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move('uploads/huesped-foto', $fileName);

            $huesped->setFotografia($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($huesped);
            $em->flush();

            return $this->redirectToRoute('huesped_show', array('id' => $huesped->getId()));
        }

        return $this->render('huesped/new.html.twig', array(
            'huesped' => $huesped,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a huesped entity.
     *
     * @Route("/{id}", name="huesped_show")
     * @Method("GET")
     */
    public function showAction(Huesped $huesped)
    {
        $deleteForm = $this->createDeleteForm($huesped);

        return $this->render('huesped/show.html.twig', array(
            'huesped' => $huesped,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing huesped entity.
     *
     * @Route("/{id}/edit", name="huesped_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Huesped $huesped)
    {
        $deleteForm = $this->createDeleteForm($huesped);
        $editForm = $this->createForm('AppBundle\Form\HuespedType', $huesped);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('huesped_edit', array('id' => $huesped->getId()));
        }

        return $this->render('huesped/edit.html.twig', array(
            'huesped' => $huesped,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a huesped entity.
     *
     * @Route("/{id}", name="huesped_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Huesped $huesped)
    {
        $form = $this->createDeleteForm($huesped);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($huesped);
            $em->flush();
        }

        return $this->redirectToRoute('huesped_index');
    }

    /**
     * Creates a form to delete a huesped entity.
     *
     * @param Huesped $huesped The huesped entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Huesped $huesped)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('huesped_delete', array('id' => $huesped->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
