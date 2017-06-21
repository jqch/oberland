<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * HabitacionTipo
 *
 * @ORM\Table(name="habitacion_tipo")
 * @ORM\Entity
 */
class HabitacionTipo
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
     * @ORM\Column(name="habitacion_tipo", type="string", length=50, nullable=true)
     */
    private $habitacionTipo;

    public function __toString(){
        return $this->habitacionTipo;
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
     * Set habitacionTipo
     *
     * @param string $habitacionTipo
     *
     * @return HabitacionTipo
     */
    public function setHabitacionTipo($habitacionTipo)
    {
        $this->habitacionTipo = $habitacionTipo;

        return $this;
    }

    /**
     * Get habitacionTipo
     *
     * @return string
     */
    public function getHabitacionTipo()
    {
        return $this->habitacionTipo;
    }
}
