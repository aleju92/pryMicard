<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriaRepository")
 */
class Categoria
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
     * @ORM\Column(name="desCat", type="string", length=100, unique=true)
     */
    private $desCat;
	
    /**
     * @ORM\Column(name="estCat", type="smallint")
     * */
	private $estado;//1=activo 0=inactivo

    /**
     * @ORM\OneToMany(targetEntity="Promocion", mappedBy="catPromFk")
     */
    private $promociones;
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
     * Set desCat
     *
     * @param string $desCat
     *
     * @return Categoria
     */
    public function setDesCat($desCat)
    {
        $this->desCat = $desCat;

        return $this;
    }

    /**
     * Get desCat
     *
     * @return string
     */
    public function getDesCat()
    {
        return $this->desCat;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Categoria
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
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
     * @return Categoria
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
    
}
