<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Credito
 *
 * @ORM\Table(name="credito")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CreditoRepository")
 */
class Credito
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
     *
     * @ORM\Column(name="monto", type="integer")
     */
    private $monto;

    /**
     * @var int
     *
     * @ORM\Column(name="cedulafk", type="integer", length=10)
     */
    private $cedulafk;


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
     * Set monto
     *
     * @param integer $monto
     *
     * @return Credito
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;

        return $this;
    }

    /**
     * Get monto
     *
     * @return int
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set cedulafk
     *
     * @param integer $cedulafk
     *
     * @return Credito
     */
    public function setCedulafk($cedulafk)
    {
        $this->cedulafk = $cedulafk;

        return $this;
    }

    /**
     * Get cedulafk
     *
     * @return int
     */
    public function getCedulafk()
    {
        return $this->cedulafk;
    }
}

