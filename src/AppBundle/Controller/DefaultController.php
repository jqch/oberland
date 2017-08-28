<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ReservaServicio;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/principal", name="principal")
     */
    public function principalAction(Request $request)
    {
        // Lista de habitaciones
        $em = $this->getDoctrine()->getManager();
        $habitacion = $em->getRepository('AppBundle:Habitacion')->findAll();
        $arrayHab = array();
        $cont = 0;

        $contDisponibles = 0;
        $contOcupados = 0;
        $contReservados = 0;
        $contMantenimiento = 0;

        foreach ($habitacion as $h) {
            $arrayHab[$cont] = array('habitacion'=>$h);
            $reserva = $em->createQueryBuilder()
                          ->select('r')
                          ->from('AppBundle:Reserva','r')
                          ->innerJoin('AppBundle:Habitacion','h','with','r.habitacion = h.id')
                          ->where('h.id = :idHabitacion')
                          ->setParameter('idHabitacion',$h->getId())
                          ->orderBy('r.id','DESC')
                          ->setMaxResults(1)
                          ->getQuery()
                          ->getResult();

            if($reserva){
                $fechaActual = date('d-m-Y');
                $horaActual = strtotime(date('G:i:s'));

                $fechaIngreso = $reserva[0]->getFechaIngreso()->format('d-m-Y');
                $fechaSalida = $reserva[0]->getFechaSalida()->format('d-m-Y');

                if($fechaActual >= $fechaIngreso and $fechaActual <= $fechaSalida){
                    if($reserva[0]->getReservaEstadoTipo()->getId() == 1){
                        $arrayHab[$cont]['idEstado'] = 101;
                        $arrayHab[$cont]['estado'] = 'Ocupado';
                        $contReservados++;
                    }else{
                        if($reserva[0]->getReservaEstadoTipo()->getId() == 2){
                            $arrayHab[$cont]['idEstado'] = 102;
                            $arrayHab[$cont]['estado'] = 'Reservado';
                            $contOcupados++;
                        }else{
                            $arrayHab[$cont]['idEstado'] = 100;
                            $arrayHab[$cont]['estado'] = 'Disponible';
                            $contDisponibles++;
                        }
                    }
                }else{
                    $arrayHab[$cont]['idEstado'] = 100;
                    $arrayHab[$cont]['estado'] = 'Disponible';
                    $contDisponibles++;
                }
                $arrayHab[$cont]['idReserva'] = $reserva[0]->getId();
            }else{
                if($h->getEstadoTipo()->getId() == 1){
                    $arrayHab[$cont]['idEstado'] = 100;
                    $contDisponibles++;
                }else{
                    $arrayHab[$cont]['idEstado'] = 103;
                    $contMantenimiento++;
                }
                $arrayHab[$cont]['estado'] = $h->getEstadoTipo()->getEstado();
                $arrayHab[$cont]['idReserva'] = null;
            }

            $cont++;
        }

        return $this->render('default/principal.html.twig', array(
            'habitaciones'=>$arrayHab,
            'contDisponibles' => $contDisponibles,
            'contReservados' => $contReservados,
            'contOcupados' => $contOcupados,
            'contMantenimiento' => $contMantenimiento
        ));
    }

    /**
     * @Route("/administracion", name="administracion")
     */
    public function administracionAction(Request $request)
    {
        // Obtnemos el id de la reserva e id de la habitacion
        $idHabitacion = $request->get('idHabitacion');
        $idEstado = $request->get('idEstado');
        $idReserva = $request->get('idReserva');

        $em = $this->getDoctrine()->getManager();

        switch ($idEstado) {
            case 100:
                $estado = 'Disponible';
                $reserva = null;
                $servicios = null;
                break;
            case 101:
                $estado = 'Ocupado';
                $reserva = $em->getRepository('AppBundle:Reserva')->find($idReserva);
                $servicios = $em->getRepository('AppBundle:ReservaServicio')->findBy(array('reserva'=>$idReserva));
                break;
            case 102:
                $estado = 'Reservado';
                $reserva = $em->getRepository('AppBundle:Reserva')->find($idReserva);
                $servicios = null;
                break;
            case 103:
                $estado = 'Mantenimiento';
                $reserva = null;
                $servicios = null;
                break;
        }

        $habitacion = $em->getRepository('AppBundle:Habitacion')->find($idHabitacion);

        return $this->render('default/administracion.html.twig',array(
            'habitacion'=>$habitacion,
            'idEstado'=> $idEstado,
            'estado' => $estado,
            'reserva' => $reserva,
            'servicios'=> $servicios
        ));
    }

    /**
     * @Route("/administracion/cambiarEstado", name="cambiarEstado")
     */
    public function cambiarEstadoAction(Request $request)
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $idReserva = $request->get('idReserva');
            $nuevoEstado = $request->get('nuevoEstado');
            $reserva = $em->getRepository('AppBundle:Reserva')->find($idReserva);
            $reserva->setReservaEstadoTipo($em->getRepository('AppBundle:ReservaEstadoTipo')->find($nuevoEstado));
            $em->flush();

            // Si se confirma la reserva se genera el servicio de hospedaje
            if($nuevoEstado == 1){
                $nuevoServicio = new ReservaServicio();
                $nuevoServicio->setReserva($em->getRepository('AppBundle:Reserva')->find($idReserva));
                $nuevoServicio->setServicioTipo($em->getRepository('AppBundle:ServicioTipo')->find(1));
                $nuevoServicio->setFechaRegistro(new \DateTime('now'));
                $nuevoServicio->setHoraRegistro(new \DateTime('now'));
                $nuevoServicio->setMonto(200);
                $nuevoServicio->setSaldo(200);
                $em->persist($nuevoServicio);
                $em->flush();
            }

            return $this->redirectToRoute('principal');

        } catch (Exception $e) {

        }
    }
}
