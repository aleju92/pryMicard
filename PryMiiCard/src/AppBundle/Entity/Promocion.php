<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Promocion
 *
 * @ORM\Table(name="promocion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PromocionRepository")
 */
class Promocion
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
     * @ORM\Column(name="titProm", type="string", length=150)
     */
    private $titProm;

    /**
     * @var string
     *
     * @ORM\Column(name="detProm", type="text", nullable=true)
     */
    private $detProm;

    /**
     * @var bool
     *
     * @ORM\Column(name="tipProm", type="boolean")
     */
    private $tipProm;

    /**
     * @var int
     *
     * @ORM\Column(name="numProm", type="integer", nullable=true)
     */
    private $numProm;

    /**
     * @var string
     *
     * @ORM\Column(name="preProm", type="decimal", precision=10, scale=0)
     */
    private $preProm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechInProm", type="datetime")
     */
    private $fechInProm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechFinProm", type="datetime", nullable=true)
     */
    private $fechFinProm;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="Promocion")
     * @ORM\JoinColumn(name="catPromFk", referencedColumnName="id")
     */
    private $catPromFk;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="Promocion")
     * @ORM\JoinColumn(name="empPromFk", referencedColumnName="id")
     */
    private $empPromFk;

    /**
     * @ORM\Column(name="estProm", type="smallint")
     * */
    private $estProm;//1=activo 0=inactivo

    /**
     * @ORM\OneToMany(targetEntity="Reserva", mappedBy="promResFk")
     */
    private $Reservas;
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
     * Set titProm
     *
     * @param string $titProm
     *
     * @return Promocion
     */
    public function setTitProm($titProm)
    {
        $this->titProm = $titProm;

        return $this;
    }

    /**
     * Get titProm
     *
     * @return string
     */
    public function getTitProm()
    {
        return $this->titProm;
    }

    /**
     * Set detProm
     *
     * @param string $detProm
     *
     * @return Promocion
     */
    public function setDetProm($detProm)
    {
        $this->detProm = $detProm;

        return $this;
    }

    /**
     * Get detProm
     *
     * @return string
     */
    public function getDetProm()
    {
        return $this->detProm;
    }

    /**
     * Set tipProm
     *
     * @param boolean $tipProm
     *
     * @return Promocion
     */
    public function setTipProm($tipProm)
    {
        $this->tipProm = $tipProm;

        return $this;
    }

    /**
     * Get tipProm
     *
     * @return bool
     */
    public function getTipProm()
    {
        return $this->tipProm;
    }

    /**
     * Set numProm
     *
     * @param integer $numProm
     *
     * @return Promocion
     */
    public function setNumProm($numProm)
    {
        $this->numProm = $numProm;

        return $this;
    }

    /**
     * Get numProm
     *
     * @return int
     */
    public function getNumProm()
    {
        return $this->numProm;
    }

    /**
     * Set preCred
     *
     * @param string $preCred
     *
     * @return Promocion
     */
    public function setPreCred($preCred)
    {
        $this->preCred = $preCred;

        return $this;
    }

    /**
     * Get preCred
     *
     * @return string
     */
    public function getPreCred()
    {
        return $this->preCred;
    }

    /**
     * Set fechInProm
     *
     * @param \DateTime $fechInProm
     *
     * @return Promocion
     */
    public function setFechInProm($fechInProm)
    {
        $this->fechInProm = $fechInProm;

        return $this;
    }

    /**
     * Get fechInProm
     *
     * @return \DateTime
     */
    public function getFechInProm()
    {
        return $this->fechInProm;
    }

    /**
     * Set fechFinProm
     *
     * @param \DateTime $fechFinProm
     *
     * @return Promocion
     */
    public function setFechFinProm($fechFinProm)
    {
        $this->fechFinProm = $fechFinProm;

        return $this;
    }

    /**
     * Get fechFinProm
     *
     * @return \DateTime
     */
    public function getFechFinProm()
    {
        return $this->fechFinProm;
    }

    /**
     * Set catPromFk
     *
     * @param integer $catPromFk
     *
     * @return Promocion
     */
    public function setCatPromFk($catPromFk)
    {
        $this->catPromFk = $catPromFk;

        return $this;
    }

    /**
     * Get catPromFk
     *
     * @return int
     */
    public function getCatPromFk()
    {
        return $this->catPromFk;
    }

    /**
     * Set empPromFk
     *
     * @param integer $empPromFk
     *
     * @return Promocion
     */
    public function setEmpPromFk($empPromFk)
    {
        $this->empPromFk = $empPromFk;

        return $this;
    }

    /**
     * Get empPromFk
     *
     * @return int
     */
    public function getEmpPromFk()
    {
        return $this->empPromFk;
    }

    /**
     * Set preProm
     *
     * @param string $preProm
     *
     * @return Promocion
     */
    public function setPreProm($preProm)
    {
        $this->preProm = $preProm;

        return $this;
    }

    /**
     * Get preProm
     *
     * @return string
     */
    public function getPreProm()
    {
        return $this->preProm;
    }

    /**
     * Set estProm
     *
     * @param integer $estProm
     *
     * @return Promocion
     */
    public function setEstProm($estProm)
    {
        $this->estProm = $estProm;

        return $this;
    }

    /**
     * Get estProm
     *
     * @return integer
     */
    public function getEstProm()
    {
        return $this->estProm;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->Reservas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     *
     * @return Promocion
     */
    public function addReserva(\AppBundle\Entity\Reserva $reserva)
    {
        $this->Reservas[] = $reserva;

        return $this;
    }

    /**
     * Remove reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     */
    public function removeReserva(\AppBundle\Entity\Reserva $reserva)
    {
        $this->Reservas->removeElement($reserva);
    }

    /**
     * Get reservas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservas()
    {
        return $this->Reservas;
    }
}
