<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reserva
 *
 * @ORM\Table(name="reserva")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReservaRepository")
 */
class Reserva
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
     * @var int
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="Reserva")
     * @ORM\JoinColumn(name="usuResFk", referencedColumnName="id")
     */
    private $usuResFk;

    /**
     * @var int
     * @ORM\ManyToOne(targetEntity="Promocion", inversedBy="Reserva")
     * @ORM\JoinColumn(name="promResFk", referencedColumnName="id")
     */
    private $promResFk;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechRes", type="datetime")
     */
    private $fechRes;

    /**
     * @var int
     *
     * @ORM\Column(name="estRes", type="smallint")
     */
    private $estRes;


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
     * Set usuRes
     *
     * @param integer $usuRes
     *
     * @return Reserva
     */
    public function setUsuRes($usuRes)
    {
        $this->usuRes = $usuRes;

        return $this;
    }

    /**
     * Get usuRes
     *
     * @return int
     */
    public function getUsuRes()
    {
        return $this->usuRes;
    }

    /**
     * Set promRes
     *
     * @param integer $promRes
     *
     * @return Reserva
     */
    public function setPromRes($promRes)
    {
        $this->promRes = $promRes;

        return $this;
    }

    /**
     * Get promRes
     *
     * @return int
     */
    public function getPromRes()
    {
        return $this->promRes;
    }

    /**
     * Set fechRes
     *
     * @param \DateTime $fechRes
     *
     * @return Reserva
     */
    public function setFechRes($fechRes)
    {
        $this->fechRes = $fechRes;

        return $this;
    }

    /**
     * Get fechRes
     *
     * @return \DateTime
     */
    public function getFechRes()
    {
        return $this->fechRes;
    }

    /**
     * Set estRes
     *
     * @param integer $estRes
     *
     * @return Reserva
     */
    public function setEstRes($estRes)
    {
        $this->estRes = $estRes;

        return $this;
    }

    /**
     * Get estRes
     *
     * @return int
     */
    public function getEstRes()
    {
        return $this->estRes;
    }

    /**
     * Set usuResFk
     *
     * @param \AppBundle\Entity\Usuario $usuResFk
     *
     * @return Reserva
     */
    public function setUsuResFk(\AppBundle\Entity\Usuario $usuResFk = null)
    {
        $this->usuResFk = $usuResFk;

        return $this;
    }

    /**
     * Get usuResFk
     *
     * @return \AppBundle\Entity\Usuario
     */
    public function getUsuResFk()
    {
        return $this->usuResFk;
    }

    /**
     * Set promResFk
     *
     * @param \AppBundle\Entity\Promocion $promResFk
     *
     * @return Reserva
     */
    public function setPromResFk(\AppBundle\Entity\Promocion $promResFk = null)
    {
        $this->promResFk = $promResFk;

        return $this;
    }

    /**
     * Get promResFk
     *
     * @return \AppBundle\Entity\Promocion
     */
    public function getPromResFk()
    {
        return $this->promResFk;
    }
}
