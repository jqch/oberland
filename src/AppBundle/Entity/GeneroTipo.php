<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeneroTipo
 *
 * @ORM\Table(name="genero_tipo")
 * @ORM\Entity
 */
class GeneroTipo
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
     * @ORM\Column(name="genero", type="string", length=2, nullable=true)
     */
    private $genero;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="string", length=20, nullable=true)
     */
    private $detalle;

    public function __toString(){
        return $this->genero;
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
     * Set genero
     *
     * @param string $genero
     *
     * @return GeneroTipo
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get genero
     *
     * @return string
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     *
     * @return GeneroTipo
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
