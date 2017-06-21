<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Habitacion
 *
 * @ORM\Table(name="habitacion", indexes={@ORM\Index(name="fk_habitacion_tipo_id", columns={"habitacion_tipo_id"}), @ORM\Index(name="fk_piso_tipo_id", columns={"piso_tipo_id"}), @ORM\Index(name="fk_estado_tipo_id", columns={"estado_tipo_id"})})
 * @ORM\Entity
 */
class Habitacion
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
     * @var integer
     *
     * @ORM\Column(name="capacidad", type="integer", nullable=true)
     */
    private $capacidad;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $precio;

    /**
     * @var string
     *
     * @ORM\Column(name="nro_habitacion", type="string", length=11, nullable=true)
     */
    private $nroHabitacion;

    /**
     * @var \EstadoTipo
     *
     * @ORM\ManyToOne(targetEntity="EstadoTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estado_tipo_id", referencedColumnName="id")
     * })
     */
    private $estadoTipo;

    /**
     * @var \HabitacionTipo
     *
     * @ORM\ManyToOne(targetEntity="HabitacionTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="habitacion_tipo_id", referencedColumnName="id")
     * })
     */
    private $habitacionTipo;

    /**
     * @var \PisoTipo
     *
     * @ORM\ManyToOne(targetEntity="PisoTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="piso_tipo_id", referencedColumnName="id")
     * })
     */
    private $pisoTipo;

    public function __toString(){
        return $this->nroHabitacion;
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
     * Set capacidad
     *
     * @param integer $capacidad
     *
     * @return Habitacion
     */
    public function setCapacidad($capacidad)
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    /**
     * Get capacidad
     *
     * @return integer
     */
    public function getCapacidad()
    {
        return $this->capacidad;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return Habitacion
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return string
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set nroHabitacion
     *
     * @param integer $nroHabitacion
     *
     * @return Habitacion
     */
    public function setNroHabitacion($nroHabitacion)
    {
        $this->nroHabitacion = $nroHabitacion;

        return $this;
    }

    /**
     * Get nroHabitacion
     *
     * @return integer
     */
    public function getNroHabitacion()
    {
        return $this->nroHabitacion;
    }

    /**
     * Set estadoTipo
     *
     * @param \AppBundle\Entity\EstadoTipo $estadoTipo
     *
     * @return Habitacion
     */
    public function setEstadoTipo(\AppBundle\Entity\EstadoTipo $estadoTipo = null)
    {
        $this->estadoTipo = $estadoTipo;

        return $this;
    }

    /**
     * Get estadoTipo
     *
     * @return \AppBundle\Entity\EstadoTipo
     */
    public function getEstadoTipo()
    {
        return $this->estadoTipo;
    }

    /**
     * Set habitacionTipo
     *
     * @param \AppBundle\Entity\HabitacionTipo $habitacionTipo
     *
     * @return Habitacion
     */
    public function setHabitacionTipo(\AppBundle\Entity\HabitacionTipo $habitacionTipo = null)
    {
        $this->habitacionTipo = $habitacionTipo;

        return $this;
    }

    /**
     * Get habitacionTipo
     *
     * @return \AppBundle\Entity\HabitacionTipo
     */
    public function getHabitacionTipo()
    {
        return $this->habitacionTipo;
    }

    /**
     * Set pisoTipo
     *
     * @param \AppBundle\Entity\PisoTipo $pisoTipo
     *
     * @return Habitacion
     */
    public function setPisoTipo(\AppBundle\Entity\PisoTipo $pisoTipo = null)
    {
        $this->pisoTipo = $pisoTipo;

        return $this;
    }

    /**
     * Get pisoTipo
     *
     * @return \AppBundle\Entity\PisoTipo
     */
    public function getPisoTipo()
    {
        return $this->pisoTipo;
    }
}
