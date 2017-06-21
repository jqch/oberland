<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservaEstadoTipo
 *
 * @ORM\Table(name="reserva_estado_tipo")
 * @ORM\Entity
 */
class ReservaEstadoTipo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="reserva_estado_tipo", type="string", length=100, nullable=true)
     */
    private $reservaEstadoTipo;

    public function __toString(){
        return $this->reservaEstadoTipo;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set reservaEstadoTipo
     *
     * @param string $reservaEstadoTipo
     *
     * @return ReservaEstadoTipo
     */
    public function setReservaEstadoTipo($reservaEstadoTipo)
    {
        $this->reservaEstadoTipo = $reservaEstadoTipo;

        return $this;
    }

    /**
     * Get reservaEstadoTipo
     *
     * @return string
     */
    public function getReservaEstadoTipo()
    {
        return $this->reservaEstadoTipo;
    }
}
