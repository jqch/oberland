<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PisoTipo
 *
 * @ORM\Table(name="piso_tipo")
 * @ORM\Entity
 */
class PisoTipo
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
     * @ORM\Column(name="piso", type="integer", nullable=true)
     */
    private $piso;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="string", length=100, nullable=true)
     */
    private $detalle;

    public function __toString(){
        return $this->detalle;
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
     * Set piso
     *
     * @param integer $piso
     *
     * @return PisoTipo
     */
    public function setPiso($piso)
    {
        $this->piso = $piso;

        return $this;
    }

    /**
     * Get piso
     *
     * @return integer
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     *
     * @return PisoTipo
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get detalle
     *
     * @return string
     */
    public function getDetalle()
    {
        return $this->detalle;
    }
}
