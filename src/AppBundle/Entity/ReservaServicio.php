<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservaServicio
 *
 * @ORM\Table(name="reserva_servicio", indexes={@ORM\Index(name="fk_reserva_id", columns={"reserva_id"}), @ORM\Index(name="fk_servicio_tipo_id", columns={"servicio_tipo_id"}), @ORM\Index(name="fk_usuario", columns={"usuario_id"})})
 * @ORM\Entity
 */
class ReservaServicio
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
     * @ORM\Column(name="monto", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $monto;

    /**
     * @var string
     *
     * @ORM\Column(name="saldo", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $saldo;

    /**
     * @var \Reserva
     *
     * @ORM\ManyToOne(targetEntity="Reserva")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reserva_id", referencedColumnName="id")
     * })
     */
    private $reserva;

    /**
     * @var \ServicioTipo
     *
     * @ORM\ManyToOne(targetEntity="ServicioTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="servicio_tipo_id", referencedColumnName="id")
     * })
     */
    private $servicioTipo;

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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return ReservaServicio
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
     * @return ReservaServicio
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
     * Set monto
     *
     * @param string $monto
     *
     * @return ReservaServicio
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return string
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set saldo
     *
     * @param string $saldo
     *
     * @return ReservaServicio
     */
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

        return $this;
    }

    /**
     * Get saldo
     *
     * @return string
     */
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * Set reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     *
     * @return ReservaServicio
     */
    public function setReserva(\AppBundle\Entity\Reserva $reserva = null)
    {
        $this->reserva = $reserva;

        return $this;
    }

    /**
     * Get reserva
     *
     * @return \AppBundle\Entity\Reserva
     */
    public function getReserva()
    {
        return $this->reserva;
    }

    /**
     * Set servicioTipo
     *
     * @param \AppBundle\Entity\ServicioTipo $servicioTipo
     *
     * @return ReservaServicio
     */
    public function setServicioTipo(\AppBundle\Entity\ServicioTipo $servicioTipo = null)
    {
        $this->servicioTipo = $servicioTipo;

        return $this;
    }

    /**
     * Get servicioTipo
     *
     * @return \AppBundle\Entity\ServicioTipo
     */
    public function getServicioTipo()
    {
        return $this->servicioTipo;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\User $usuario
     *
     * @return ReservaServicio
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
