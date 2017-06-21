<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResidenciaTipo
 *
 * @ORM\Table(name="residencia_tipo")
 * @ORM\Entity
 */
class ResidenciaTipo
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
     * @ORM\Column(name="residencia", type="string", length=50, nullable=true)
     */
    private $residencia;

    /**
     * @var string
     *
     * @ORM\Column(name="abrev", type="string", length=5, nullable=true)
     */
    private $abrev;

    public function __toString(){
        return $this->residencia;
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
     * Set residencia
     *
     * @param string $residencia
     *
     * @return ResidenciaTipo
     */
    public function setResidencia($residencia)
    {
        $this->residencia = $residencia;

        return $this;
    }

    /**
     * Get residencia
     *
     * @return string
     */
    public function getResidencia()
    {
        return $this->residencia;
    }

    /**
     * Set abrev
     *
     * @param string $abrev
     *
     * @return ResidenciaTipo
     */
    public function setAbrev($abrev)
    {
        $this->abrev = $abrev;

        return $this;
    }

    /**
     * Get abrev
     *
     * @return string
     */
    public function getAbrev()
    {
        return $this->abrev;
    }
}
