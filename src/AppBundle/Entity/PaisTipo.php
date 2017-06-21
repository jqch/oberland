<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PaisTipo
 *
 * @ORM\Table(name="pais_tipo")
 * @ORM\Entity
 */
class PaisTipo
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
     * @ORM\Column(name="pais", type="string", length=100, nullable=true)
     */
    private $pais;

    /**
     * @var string
     *
     * @ORM\Column(name="abrev", type="string", length=5, nullable=true)
     */
    private $abrev;

    public function __toString(){
        return $this->pais;
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
     * Set pais
     *
     * @param string $pais
     *
     * @return PaisTipo
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set abrev
     *
     * @param string $abrev
     *
     * @return PaisTipo
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
