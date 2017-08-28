<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Reserva;
use AppBundle\Entity\ReservaServicio;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Reserva controller.
 *
 * @Route("reserva")
 */
class ReservaController extends Controller
{
    /**
     * Lists all reserva entities.
     *
     * @Route("/", name="reserva_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservas = $em->getRepository('AppBundle:Reserva')->findAll();

        return $this->render('reserva/index.html.twig', array(
            'reservas' => $reservas,
        ));
    }

    /**
     * @Route("/buscarHuesped", name="reserva_buscarHuesped")
     * @Method({"POST"})
     */
    public function searchAction(Request $request){
        dump($request->get('id'));
        die;
        return 0;
    }

    /**
     * Creates a new reserva entity.
     *
     * @Route("/new", name="reserva_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $reserva = new Reserva();
        $form = $this->createForm('AppBundle\Form\ReservaType', $reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $idHuesped = $request->get('idHuesped');
            $reserva->setHuesped($em->getRepository('AppBundle:Huesped')->find($idHuesped));
            $reserva->setFechaRegistro(new \DateTime('now'));
            $reserva->setHoraRegistro(new \DateTime('now'));
            $em->persist($reserva);
            $em->flush();

            // Registro de reserva_servicio
            $newReservaServicio = new ReservaServicio();
            $newReservaServicio->setReserva($em->getRepository('AppBundle:Reserva')->find($reserva->getId()));
            $newReservaServicio->setServicioTipo($em->getRepository('AppBundle:ServicioTipo')->find(1));
            $newReservaServicio->setUsuario();
            $newReservaServicio->setFechaRegistro(new \DateTime('now'));
            $newReservaServicio->setHoraRegistro(new \DateTime('now'));
            $newReservaServicio->setMonto($reserva->getPrecioActual());
            $newReservaServicio->setSaldo($reserva->getPrecioActual());
            $em->persist($newReservaServicio);
            $em->flush();


            return $this->redirectToRoute('reserva_show', array('id' => $reserva->getId()));
        }

        return $this->render('reserva/new.html.twig', array(
            'reserva' => $reserva,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reserva entity.
     *
     * @Route("/{id}", name="reserva_show")
     * @Method("GET")
     */
    public function showAction(Reserva $reserva)
    {
        $deleteForm = $this->createDeleteForm($reserva);

        return $this->render('reserva/show.html.twig', array(
            'reserva' => $reserva,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reserva entity.
     *
     * @Route("/{id}/edit", name="reserva_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Reserva $reserva)
    {
        $deleteForm = $this->createDeleteForm($reserva);
        $editForm = $this->createForm('AppBundle\Form\ReservaType', $reserva);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $em = $this->getDoctrine()->getManager();
            // Obtenemos el dato del monto en reserva_servicio
            $reservaServicio = $em->getRepository('AppBundle:ReservaServicio')->findOneBy(array('reserva'=>$reserva->getId(),'servicioTipo'=>1));
            if($reservaServicio){
                $reservaServicio->setMonto($reserva->getPrecioActual());
                $reservaServicio->setSaldo($reserva->getPrecioActual());
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reserva_index');
            return $this->redirectToRoute('reserva_edit', array('id' => $reserva->getId()));
        }

        return $this->render('reserva/edit.html.twig', array(
            'reserva' => $reserva,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reserva entity.
     *
     * @Route("/{id}", name="reserva_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Reserva $reserva)
    {
        $form = $this->createDeleteForm($reserva);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reserva);
            $em->flush();
        }

        return $this->redirectToRoute('reserva_index');
    }

    /**
     * Creates a form to delete a reserva entity.
     *
     * @param Reserva $reserva The reserva entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Reserva $reserva)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reserva_delete', array('id' => $reserva->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * Buscar huesped
     *
     * @Route("reserva/huesped/find/documento/{documento}", options={"expose"=true}, name="reserva_huesped_find_documento")
     * @Method("GET")
     */
    public function huespedFindDocumentoAction($documento)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $huesped = $em->getRepository('AppBundle:Huesped')->findOneBy(array('documento'=>$documento));
            if(!$huesped){
                $huesped = null;
            }
            return $this->render('reserva/huesped.html.twig', array(
                'huesped'=>$huesped
            ));
        } catch (Exception $e) {

        }
    }
}
