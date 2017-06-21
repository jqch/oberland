<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pago
 *
 * @ORM\Table(name="pago", indexes={@ORM\Index(name="fk_reserva_servicio_id", columns={"reserva_servicio_id"}), @ORM\Index(name="fk_pago_tipo_id", columns={"pago_tipo_id"}), @ORM\Index(name="fk_usuarioss", columns={"usuario_id"})})
 * @ORM\Entity
 */
class Pago
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
     * @ORM\Column(name="pago", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $pago;

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
     * @var \PagoTipo
     *
     * @ORM\ManyToOne(targetEntity="PagoTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pago_tipo_id", referencedColumnName="id")
     * })
     */
    private $pagoTipo;

    /**
     * @var \ReservaServicio
     *
     * @ORM\ManyToOne(targetEntity="ReservaServicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reserva_servicio_id", referencedColumnName="id")
     * })
     */
    private $reservaServicio;

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
     * Set pago
     *
     * @param string $pago
     *
     * @return Pago
     */
    public function setPago($pago)
    {
        $this->pago = $pago;

        return $this;
    }

    /**
     * Get pago
     *
     * @return string
     */
    public function getPago()
    {
        return $this->pago;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     *
     * @return Pago
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
     * @return Pago
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
     * @return Pago
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
     * Set pagoTipo
     *
     * @param \AppBundle\Entity\PagoTipo $pagoTipo
     *
     * @return Pago
     */
    public function setPagoTipo(\AppBundle\Entity\PagoTipo $pagoTipo = null)
    {
        $this->pagoTipo = $pagoTipo;

        return $this;
    }

    /**
     * Get pagoTipo
     *
     * @return \AppBundle\Entity\PagoTipo
     */
    public function getPagoTipo()
    {
        return $this->pagoTipo;
    }

    /**
     * Set reservaServicio
     *
     * @param \AppBundle\Entity\ReservaServicio $reservaServicio
     *
     * @return Pago
     */
    public function setReservaServicio(\AppBundle\Entity\ReservaServicio $reservaServicio = null)
    {
        $this->reservaServicio = $reservaServicio;

        return $this;
    }

    /**
     * Get reservaServicio
     *
     * @return \AppBundle\Entity\ReservaServicio
     */
    public function getReservaServicio()
    {
        return $this->reservaServicio;
    }

    /**
     * Set usuario
     *
     * @param \AppBundle\Entity\User $usuario
     *
     * @return Pago
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
