<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reserva
 *
 * @ORM\Table(name="reserva", indexes={@ORM\Index(name="fk_huesped_id", columns={"huesped_id"}), @ORM\Index(name="fk_habitacion_id", columns={"habitacion_id"}), @ORM\Index(name="fk_reserva_estado_tipo_id", columns={"reserva_estado_tipo_id"}), @ORM\Index(name="fk_usuario_id", columns={"usuario_id"})})
 * @ORM\Entity
 */
class Reserva
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date", nullable=true)
     */
    private $fechaIngreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_salida", type="date", nullable=true)
     */
    private $fechaSalida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horario_entrada_estimado", type="time", nullable=true)
     */
    private $horarioEntradaEstimado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="date", nullable=true)
     */
    private $fechaRegistro;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_registro", type="time", nullable=true)
     */
    private $horaRegistro;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="string", length=255, nullable=true)
     */
    private $obs;

    /**
     * @var string
     *
     * @ORM\Column(name="precio_actual", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $precioActual;

    /**
     * @var \Habitacion
     *
     * @ORM\ManyToOne(targetEntity="Habitacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="habitacion_id", referencedColumnName="id")
     * })
     */
    private $habitacion;

    /**
     * @var \Huesped
     *
     * @ORM\ManyToOne(targetEntity="Huesped", cascade="persist")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="huesped_id", referencedColumnName="id")
     * })
     */
    private $huesped;

    /**
     * @var \ReservaEstadoTipo
     *
     * @ORM\ManyToOne(targetEntity="ReservaEstadoTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reserva_estado_tipo_id", referencedColumnName="id")
     * })
     */
    private $reservaEstadoTipo;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario_id", referencedColumnName="id")
     * })
     */
    private $usuario;



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
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return Reserva
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set fechaSalida
     *
     * @param \DateTime $fechaSalida
     *
     * @return Reserva
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    /**
     * Get fechaSalida
     *
     * @return \DateTime
     */
    public function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * Set horarioEntradaEstimado
     *
     * @param \DateTime $horarioEntradaEstimado
     *
     * @return Reserva
     */
    public function setHorarioEntradaEstimado($horarioEntradaEstimado)
    {
        $this->horarioEntradaEstimado = $horarioEntradaEstimado;

        return $this;
    }

    /**
     * Get horarioEntradaEstimado
     *
     * @return \DateTime
     */
    public function getHorarioEntradaEstimado()
    {
        return $this->horarioEntradaEstimado;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return Reserva
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;

        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set horaRegistro
     *
     * @param \DateTime $horaRegistro
     *
     * @return Reserva
     */
    public function setHoraRegistro($horaRegistro)
    {
        $this->horaRegistro = $horaRegistro;

        return $this;
    }

    /**
     * Get horaRegistro
     *
     * @return \DateTime
     */
    public function getHoraRegistro()
    {
        return $this->horaRegistro;
    }

    /**
     * Set obs
     *
     * @param string $obs
     *
     * @return Reserva
     */
    public function setObs($obs)
    {
        $this->obs = $obs;

        return $this;
    }

    /**
     * Get obs
     *
     * @return string
     */
    public function getObs()
    {
        return $this->obs;
    }

    /**
     * Set precioActual
     *
     * @param string $precioActual
     *
     * @return Reserva
     */
    public function setPrecioActual($precioActual)
    {
        $this->precioActual = $precioActual;

        return $this;
    }

    /**
     * Get precioActual
     *
     * @return string
     */
    public function getPrecioActual()
    {
        return $this->precioActual;
    }

    /**
     * Set habitacion
     *
     * @param \AppBundle\Entity\Habitacion $habitacion
     *
     * @return Reserva
     */
    public function setHabitacion(\AppBundle\Entity\Habitacion $habitacion = null)
    {
        $this->habitacion = $habitacion;

        return $this;
    }

    /**
     * Get habitacion
     *
     * @return \AppBundle\Entity\Habitacion
     */
    public function getHabitacion()
    {
        return $this->habitacion;
    }

    /**
     * Set huesped
     *
     * @param \AppBundle\Entity\Huesped $huesped
     *
     * @return Reserva
     */
    public function setHuesped(\AppBundle\Entity\Huesped $huesped = null)
    {
        $this->huesped = $huesped;

        return $this;
    }

    /**
     * Get huesped
     *
     * @return \AppBundle\Entity\Huesped
     */
    public function getHuesped()
    {
        return $this->huesped;
    }

    /**
     * Set reservaEstadoTipo
     *
     * @param \AppBundle\Entity\ReservaEstadoTipo $reservaEstadoTipo
     *
     * @return Reserva
     */
    public function setReservaEstadoTipo(\AppBundle\Entity\ReservaEstadoTipo $reservaEstadoTipo = null)
    {
        $this->reservaEstadoTipo = $reservaEstadoTipo;

        return $this;
    }

    /**
     * Get reservaEstadoTipo
     *
     * @return \AppBundle\Entity\ReservaEstadoTipo
     */
    public function getReservaEstadoTipo()
    {
        return $this->reservaEstadoTipo;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\User $usuario
     *
     * @return Reserva
     */
    public function setUsuario(\AppBundle\Entity\User $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return \AppBundle\Entity\User
     */
    public function getUsuario()
    {
        return $this->usuario;
    }
}
