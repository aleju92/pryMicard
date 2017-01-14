<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Administrador
 *
 * @ORM\Table(name="administrador")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdministradorRepository")
 */
class Administrador
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomAdm", type="string", length=50)
     */
    private $nomAdm;

    /**
     * @var string
     *
     * @ORM\Column(name="apeAdm", type="string", length=50)
     */
    private $apeAdm;

    /**
     * @var string
     *
     * @ORM\Column(name="emAdm", type="string", length=100, nullable=true)
     */
    private $emAdm;

    /**
     * @var string
     *
     * @ORM\Column(name="useAdm", type="string", length=100, unique=true)
     */
    private $useAdm;

    /**
     * @var string
     *
     * @ORM\Column(name="passAdm", type="string", length=255)
     */
    private $passAdm;

    /**
     * @var int
     *
     * @ORM\Column(name="tipAdm", type="integer")
     */
    private $tipAdm;
	//1=adm 2=Sa
	
	/**
	 * @ORM\Column(name="estAdm",type="integer")	 
	 * */
    private $estAdm;
    //1=activo 0=inactivo

    /**
     * @ORM\OneToMany(targetEntity="Empresa", mappedBy="Administrador")
     */
    private $empresas;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nomAdm
     *
     * @param string $nomAdm
     *
     * @return Administrador
     */
    public function setNomAdm($nomAdm)
    {
        $this->nomAdm = $nomAdm;

        return $this;
    }

    /**
     * Get nomAdm
     *
     * @return string
     */
    public function getNomAdm()
    {
        return $this->nomAdm;
    }

    /**
     * Set apeAdm
     *
     * @param string $apeAdm
     *
     * @return Administrador
     */
    public function setApeAdm($apeAdm)
    {
        $this->apeAdm = $apeAdm;

        return $this;
    }

    /**
     * Get apeAdm
     *
     * @return string
     */
    public function getApeAdm()
    {
        return $this->apeAdm;
    }

    /**
     * Set emAdm
     *
     * @param string $emAdm
     *
     * @return Administrador
     */
    public function setEmAdm($emAdm)
    {
        $this->emAdm = $emAdm;

        return $this;
    }

    /**
     * Get emAdm
     *
     * @return string
     */
    public function getEmAdm()
    {
        return $this->emAdm;
    }

    /**
     * Set useAdm
     *
     * @param string $useAdm
     *
     * @return Administrador
     */
    public function setUseAdm($useAdm)
    {
        $this->useAdm = $useAdm;

        return $this;
    }

    /**
     * Get useAdm
     *
     * @return string
     */
    public function getUseAdm()
    {
        return $this->useAdm;
    }

    /**
     * Set passAdm
     *
     * @param string $passAdm
     *
     * @return Administrador
     */
    public function setPassAdm($passAdm)
    {
        $this->passAdm = $passAdm;

        return $this;
    }

    /**
     * Get passAdm
     *
     * @return string
     */
    public function getPassAdm()
    {
        return $this->passAdm;
    }

    /**
     * Set tipAdm
     *
     * @param integer $tipAdm
     *
     * @return Administrador
     */
    public function setTipAdm($tipAdm)
    {
        $this->tipAdm = $tipAdm;

        return $this;
    }

    /**
     * Get tipAdm
     *
     * @return int
     */
    public function getTipAdm()
    {
        return $this->tipAdm;
    }

    /**
     * Set estAdm
     *
     * @param integer $estAdm
     *
     * @return Administrador
     */
    public function setEstAdm($estAdm)
    {
        $this->estAdm = $estAdm;

        return $this;
    }

    /**
     * Get estAdm
     *
     * @return integer
     */
    public function getEstAdm()
    {
        return $this->estAdm;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->empresas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     *
     * @return Administrador
     */
    public function addEmpresa(\AppBundle\Entity\Empresa $empresa)
    {
        $this->empresas[] = $empresa;

        return $this;
    }

    /**
     * Remove empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     */
    public function removeEmpresa(\AppBundle\Entity\Empresa $empresa)
    {
        $this->empresas->removeElement($empresa);
    }

    /**
     * Get empresas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmpresas()
    {
        return $this->empresas;
    }
}
