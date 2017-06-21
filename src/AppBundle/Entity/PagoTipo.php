<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PagoTipo
 *
 * @ORM\Table(name="pago_tipo")
 * @ORM\Entity
 */
class PagoTipo
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
     * @ORM\Column(name="pago_tipo", type="string", length=50, nullable=true)
     */
    private $pagoTipo;

    public function __toString(){
        return $this->pagoTipo;
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
     * Set pagoTipo
     *
     * @param string $pagoTipo
     *
     * @return PagoTipo
     */
    public function setPagoTipo($pagoTipo)
    {
        $this->pagoTipo = $pagoTipo;

        return $this;
    }

    /**
     * Get pagoTipo
     *
     * @return string
     */
    public function getPagoTipo()
    {
        return $this->pagoTipo;
    }
}
