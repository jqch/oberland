<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServicioTipo
 *
 * @ORM\Table(name="servicio_tipo")
 * @ORM\Entity
 */
class ServicioTipo
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
     * @ORM\Column(name="servicio", type="string", length=255, nullable=true)
     */
    private $servicio;

    /**
     * @var string
     *
     * @ORM\Column(name="precio", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $precio;

    public function __toString(){
        return $this->servicio;
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
     * Set servicio
     *
     * @param string $servicio
     *
     * @return ServicioTipo
     */
    public function setServicio($servicio)
    {
        $this->servicio = $servicio;

        return $this;
    }

    /**
     * Get servicio
     *
     * @return string
     */
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * Set precio
     *
     * @param string $precio
     *
     * @return ServicioTipo
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
}
