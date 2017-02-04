<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
/**
 * Administrador
 *
 * @ORM\Table(name="administrador")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdministradorRepository")
 */
class Administrador implements UserInterface
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
     * @Assert\NotBlank()
     * @ORM\Column(name="nomAdm", type="string", length=50)
     */
    private $nomAdm;

    /**
     * @var string
     * @Assert\NotBlank()
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
     * Image file
     *
     * @var File
     *
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     maxSizeMessage = "Lo máximo permitido es 5MB",
     *     mimeTypesMessage = "Solo se permite los formatos: .jpg .gif .png"
     * )
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $photoAdm;

    /**
     * @var string
     *@Assert\NotBlank()
     *
     * @ORM\Column(name="useAdm", type="string", length=100, unique=true)
     */
    private $useAdm;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $PasswordTemp;

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
     * @ORM\OneToMany(targetEntity="Empresa", mappedBy="admiPromFk")
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
     * Set passAdm
     *
     * @param string $passAdm
     *
     * @return Administrador
     */
    public function setPasswordTemp($PasswordTemp)
    {
        $this->PasswordTemp = $PasswordTemp;

        return $this;
    }

    /**
     * Get passAdm
     *
     * @return string
     */
    public function getPasswordTemp()
    {
        return $this->PasswordTemp;
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

    /**
     * Set photoAdm
     *
     * @param string $photoAdm
     *
     * @return Administrador
     */
    public function setPhotoAdm($photoAdm)
    {
        $this->photoAdm = $photoAdm;

        return $this;
    }

    /**
     * Get photoAdm
     *
     * @return string
     */
    public function getPhotoAdm()
    {
        return $this->photoAdm;
    }

    /**
     * @return string
     */
    public function getPathPhotoAdm()
    {
        return 'AdminPerfil/'.$this->getPhotoAdm();
    }
    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return array('ROLE_SUPADMIN');
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->getPassAdm();
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getUseAdm();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
