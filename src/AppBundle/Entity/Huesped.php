<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Huesped
 *
 * @ORM\Table(name="huesped", indexes={@ORM\Index(name="fk_documento_tipo_id", columns={"documento_tipo_id"}), @ORM\Index(name="fk_genero_tipo_id", columns={"genero_tipo_id"}), @ORM\Index(name="fk_pais_nacimiento_id", columns={"pais_nacimiento_id"}), @ORM\Index(name="fk_pais_nacionalidad_id", columns={"pais_nacionalidad_id"}), @ORM\Index(name="fk_pais_tipo_id", columns={"pais_id"}), @ORM\Index(name="fk_residencia_tipo_id", columns={"residencia_tipo"})})
 * @ORM\Entity
 */
class Huesped
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
     * @ORM\Column(name="nombre", type="string", length=50, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="string", length=100, nullable=true)
     */
    private $apellidos;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=true)
     */
    private $fechaNacimiento;


    /**
     * @var string
     *
     * @ORM\Column(name="documento", type="string", length=50, nullable=true)
     */
    private $documento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="documento_expiracion", type="date", nullable=true)
     */
    private $documentoExpiracion;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", length=100, nullable=true)
     */
    private $region;

    /**
     * @var string
     *
     * @ORM\Column(name="ciudad", type="string", length=100, nullable=true)
     */
    private $ciudad;

    /**
     * @var string
     *
     * @ORM\Column(name="residencia", type="string", length=100, nullable=true)
     */
    private $residencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_postal", type="string", length=50, nullable=true)
     */
    private $codigoPostal;

    /**
     * @var integer
     *
     * @ORM\Column(name="telefono", type="integer", nullable=true)
     */
    private $telefono;

    /**
     * @var integer
     *
     * @ORM\Column(name="celular", type="integer", nullable=true)
     */
    private $celular;

    /**
     * @var integer
     *
     * @ORM\Column(name="telefono_referencia", type="integer", nullable=true)
     */
    private $telefonoReferencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="fax", type="integer", nullable=true)
     */
    private $fax;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="fotografia", type="string", length=100, nullable=true)
     */
    private $fotografia;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="string", length=255, nullable=true)
     */
    private $obs;

    /**
     * @var \DocumentoTipo
     *
     * @ORM\ManyToOne(targetEntity="DocumentoTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="documento_tipo_id", referencedColumnName="id")
     * })
     */
    private $documentoTipo;

    /**
     * @var \GeneroTipo
     *
     * @ORM\ManyToOne(targetEntity="GeneroTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="genero_tipo_id", referencedColumnName="id")
     * })
     */
    private $generoTipo;

    /**
     * @var \PaisTipo
     *
     * @ORM\ManyToOne(targetEntity="PaisTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_nacimiento_id", referencedColumnName="id")
     * })
     */
    private $paisNacimiento;

    /**
     * @var \PaisTipo
     *
     * @ORM\ManyToOne(targetEntity="PaisTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_nacionalidad_id", referencedColumnName="id")
     * })
     */
    private $paisNacionalidad;

    /**
     * @var \PaisTipo
     *
     * @ORM\ManyToOne(targetEntity="PaisTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pais_id", referencedColumnName="id")
     * })
     */
    private $pais;

    /**
     * @var \ResidenciaTipo
     *
     * @ORM\ManyToOne(targetEntity="ResidenciaTipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="residencia_tipo", referencedColumnName="id")
     * })
     */
    private $residenciaTipo;

    public function __toString(){
        return $this->nombre.' '.$this->apellidos;
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Huesped
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Huesped
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return Huesped
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set documento
     *
     * @param string $documento
     *
     * @return Huesped
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set documentoExpiracion
     *
     * @param \DateTime $documentoExpiracion
     *
     * @return Huesped
     */
    public function setDocumentoExpiracion($documentoExpiracion)
    {
        $this->documentoExpiracion = $documentoExpiracion;

        return $this;
    }

    /**
     * Get documentoExpiracion
     *
     * @return \DateTime
     */
    public function getDocumentoExpiracion()
    {
        return $this->documentoExpiracion;
    }

    /**
     * Set region
     *
     * @param string $region
     *
     * @return Huesped
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set ciudad
     *
     * @param string $ciudad
     *
     * @return Huesped
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;

        return $this;
    }

    /**
     * Get ciudad
     *
     * @return string
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set residencia
     *
     * @param string $residencia
     *
     * @return Huesped
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
     * Set numero
     *
     * @param integer $numero
     *
     * @return Huesped
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set codigoPostal
     *
     * @param string $codigoPostal
     *
     * @return Huesped
     */
    public function setCodigoPostal($codigoPostal)
    {
        $this->codigoPostal = $codigoPostal;

        return $this;
    }

    /**
     * Get codigoPostal
     *
     * @return string
     */
    public function getCodigoPostal()
    {
        return $this->codigoPostal;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     *
     * @return Huesped
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set celular
     *
     * @param integer $celular
     *
     * @return Huesped
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return integer
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set telefonoReferencia
     *
     * @param integer $telefonoReferencia
     *
     * @return Huesped
     */
    public function setTelefonoReferencia($telefonoReferencia)
    {
        $this->telefonoReferencia = $telefonoReferencia;

        return $this;
    }

    /**
     * Get telefonoReferencia
     *
     * @return integer
     */
    public function getTelefonoReferencia()
    {
        return $this->telefonoReferencia;
    }

    /**
     * Set fax
     *
     * @param integer $fax
     *
     * @return Huesped
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return integer
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Huesped
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set fotografia
     *
     * @param string $fotografia
     *
     * @return Huesped
     */
    public function setFotografia($fotografia)
    {
        $this->fotografia = $fotografia;

        return $this;
    }

    /**
     * Get fotografia
     *
     * @return string
     */
    public function getFotografia()
    {
        return $this->fotografia;
    }

    /**
     * Set obs
     *
     * @param string $obs
     *
     * @return Huesped
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
     * Set documentoTipo
     *
     * @param \AppBundle\Entity\DocumentoTipo $documentoTipo
     *
     * @return Huesped
     */
    public function setDocumentoTipo(\AppBundle\Entity\DocumentoTipo $documentoTipo = null)
    {
        $this->documentoTipo = $documentoTipo;

        return $this;
    }

    /**
     * Get documentoTipo
     *
     * @return \AppBundle\Entity\DocumentoTipo
     */
    public function getDocumentoTipo()
    {
        return $this->documentoTipo;
    }

    /**
     * Set generoTipo
     *
     * @param \AppBundle\Entity\GeneroTipo $generoTipo
     *
     * @return Huesped
     */
    public function setGeneroTipo(\AppBundle\Entity\GeneroTipo $generoTipo = null)
    {
        $this->generoTipo = $generoTipo;

        return $this;
    }

    /**
     * Get generoTipo
     *
     * @return \AppBundle\Entity\GeneroTipo
     */
    public function getGeneroTipo()
    {
        return $this->generoTipo;
    }

    /**
     * Set paisNacimiento
     *
     * @param \AppBundle\Entity\PaisTipo $paisNacimiento
     *
     * @return Huesped
     */
    public function setPaisNacimiento(\AppBundle\Entity\PaisTipo $paisNacimiento = null)
    {
        $this->paisNacimiento = $paisNacimiento;

        return $this;
    }

    /**
     * Get paisNacimiento
     *
     * @return \AppBundle\Entity\PaisTipo
     */
    public function getPaisNacimiento()
    {
        return $this->paisNacimiento;
    }

    /**
     * Set paisNacionalidad
     *
     * @param \AppBundle\Entity\PaisTipo $paisNacionalidad
     *
     * @return Huesped
     */
    public function setPaisNacionalidad(\AppBundle\Entity\PaisTipo $paisNacionalidad = null)
    {
        $this->paisNacionalidad = $paisNacionalidad;

        return $this;
    }

    /**
     * Get paisNacionalidad
     *
     * @return \AppBundle\Entity\PaisTipo
     */
    public function getPaisNacionalidad()
    {
        return $this->paisNacionalidad;
    }

    /**
     * Set pais
     *
     * @param \AppBundle\Entity\PaisTipo $pais
     *
     * @return Huesped
     */
    public function setPais(\AppBundle\Entity\PaisTipo $pais = null)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return \AppBundle\Entity\PaisTipo
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set residenciaTipo
     *
     * @param \AppBundle\Entity\ResidenciaTipo $residenciaTipo
     *
     * @return Huesped
     */
    public function setResidenciaTipo(\AppBundle\Entity\ResidenciaTipo $residenciaTipo = null)
    {
        $this->residenciaTipo = $residenciaTipo;

        return $this;
    }

    /**
     * Get residenciaTipo
     *
     * @return \AppBundle\Entity\ResidenciaTipo
     */
    public function getResidenciaTipo()
    {
        return $this->residenciaTipo;
    }
}
