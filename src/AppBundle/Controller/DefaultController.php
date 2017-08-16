<?php

namespace AppBundle\Controller;

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
        $contReservados = 0;
        $contOcupados = 0;
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
                        $arrayHab[$cont]['estado'] = 'Reservado';
                        $contReservados++;
                    }else{
                        $arrayHab[$cont]['estado'] = 'Confirmado';
                        $contOcupados++;
                    }
                }else{
                    $arrayHab[$cont]['estado'] = 'Disponible';
                    $contDisponibles++;
                }

            }else{
                if($h->getEstadoTipo()->getId() == 1){
                    $contDisponibles++;
                }else{
                    $contMantenimiento++;
                }
                $arrayHab[$cont]['estado'] = $h->getEstadoTipo()->getEstado();
            }

            $cont++;
        }
        //dump($arrayHab);die();



        return $this->render('default/principal.html.twig', array(
            'habitaciones'=>$arrayHab,
            'contDisponibles' => $contDisponibles,
            'contReservados' => $contReservados,
            'contOcupados' => $contOcupados,
            'contMantenimiento' => $contMantenimiento
        ));
    }
}
