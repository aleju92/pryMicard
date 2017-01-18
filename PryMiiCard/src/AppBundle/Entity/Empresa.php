<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Empresa
 *
 * @ORM\Table(name="empresa")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmpresaRepository")
 */
class Empresa
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
     * @ORM\Column(name="nomEmp", type="string", length=50)
     */
    private $nomEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="usuEmp", type="string", length=50, unique=true)
     */
    private $usuEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="pasEmp", type="string", length=50)
     */
    private $pasEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="rucEmp", type="string", length=255, unique=true)
     */
    private $rucEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="tlfEmp", type="string", length=10)
     */
    private $tlfEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="webEmp", type="string", length=50, nullable=true)
     */
    private $webEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="logEmp", type="string", length=255, nullable=true)
     */
    private $logEmp;

    /**
     * @var string
     *
     * @ORM\Column(name="slgEmp", type="string", length=150, nullable=true)
     */
    private $slgEmp;

    /**
     * @var int
     *
     * @ORM\Column(name="estEmp", type="smallint")
     */
    private $estEmp;

    /**
     * @ORM\OneToMany(targetEntity="Promocion", mappedBy="empPromFk")
     */
    private $promociones;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Administrador", inversedBy="Empresa")
     * @ORM\JoinColumn(name="adminPromFk", referencedColumnName="id")
     */
    private $admiPromFk;



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
     * Set nomEmp
     *
     * @param string $nomEmp
     *
     * @return Empresa
     */
    public function setNomEmp($nomEmp)
    {
        $this->nomEmp = $nomEmp;

        return $this;
    }

    /**
     * Get nomEmp
     *
     * @return string
     */
    public function getNomEmp()
    {
        return $this->nomEmp;
    }

    /**
     * Set usuEmp
     *
     * @param string $usuEmp
     *
     * @return Empresa
     */
    public function setUsuEmp($usuEmp)
    {
        $this->usuEmp = $usuEmp;

        return $this;
    }

    /**
     * Get usuEmp
     *
     * @return string
     */
    public function getUsuEmp()
    {
        return $this->usuEmp;
    }

    /**
     * Set pasEmp
     *
     * @param string $pasEmp
     *
     * @return Empresa
     */
    public function setPasEmp($pasEmp)
    {
        $this->pasEmp = $pasEmp;

        return $this;
    }

    /**
     * Get pasEmp
     *
     * @return string
     */
    public function getPasEmp()
    {
        return $this->pasEmp;
    }

    /**
     * Set rucEmp
     *
     * @param string $rucEmp
     *
     * @return Empresa
     */
    public function setRucEmp($rucEmp)
    {
        $this->rucEmp = $rucEmp;

        return $this;
    }

    /**
     * Get rucEmp
     *
     * @return string
     */
    public function getRucEmp()
    {
        return $this->rucEmp;
    }

    /**
     * Set tlfEmp
     *
     * @param string $tlfEmp
     *
     * @return Empresa
     */
    public function setTlfEmp($tlfEmp)
    {
        $this->tlfEmp = $tlfEmp;

        return $this;
    }

    /**
     * Get tlfEmp
     *
     * @return string
     */
    public function getTlfEmp()
    {
        return $this->tlfEmp;
    }

    /**
     * Set webEmp
     *
     * @param string $webEmp
     *
     * @return Empresa
     */
    public function setWebEmp($webEmp)
    {
        $this->webEmp = $webEmp;

        return $this;
    }

    /**
     * Get webEmp
     *
     * @return string
     */
    public function getWebEmp()
    {
        return $this->webEmp;
    }

    /**
     * Set logEmp
     *
     * @param string $logEmp
     *
     * @return Empresa
     */
    public function setLogEmp($logEmp)
    {
        $this->logEmp = $logEmp;

        return $this;
    }

    /**
     * Get logEmp
     *
     * @return string
     */
    public function getLogEmp()
    {
        return $this->logEmp;
    }

    /**
     * Set slgEmp
     *
     * @param string $slgEmp
     *
     * @return Empresa
     */
    public function setSlgEmp($slgEmp)
    {
        $this->slgEmp = $slgEmp;

        return $this;
    }

    /**
     * Get slgEmp
     *
     * @return string
     */
    public function getSlgEmp()
    {
        return $this->slgEmp;
    }

    /**
     * Set estEmp
     *
     * @param integer $estEmp
     *
     * @return Empresa
     */
    public function setEstEmp($estEmp)
    {
        $this->estEmp = $estEmp;

        return $this;
    }

    /**
     * Get estEmp
     *
     * @return int
     */
    public function getEstEmp()
    {
        return $this->estEmp;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->promociones = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add promocione
     *
     * @param \AppBundle\Entity\Promocion $promocione
     *
     * @return Empresa
     */
    public function addPromocione(\AppBundle\Entity\Promocion $promocione)
    {
        $this->promociones[] = $promocione;

        return $this;
    }

    /**
     * Remove promocione
     *
     * @param \AppBundle\Entity\Promocion $promocione
     */
    public function removePromocione(\AppBundle\Entity\Promocion $promocione)
    {
        $this->promociones->removeElement($promocione);
    }

    /**
     * Get promociones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPromociones()
    {
        return $this->promociones;
    }

    /**
     * Set admiPromFk
     *
     * @param \AppBundle\Entity\Administrador $admiPromFk
     *
     * @return Empresa
     */
    public function setAdmiPromFk(\AppBundle\Entity\Administrador $admiPromFk = null)
    {
        $this->admiPromFk = $admiPromFk;

        return $this;
    }

    /**
     * Get admiPromFk
     *
     * @return \AppBundle\Entity\Administrador
     */
    public function getAdmiPromFk()
    {
        return $this->admiPromFk;
    }
}
