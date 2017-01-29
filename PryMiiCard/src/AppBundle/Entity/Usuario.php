<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */
class Usuario implements UserInterface
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
     * @ORM\Column(name="nombre", type="string", length=100)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=100)
     */
    private $apellido;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechanacim", type="datetime", nullable=true)
     */
    private $fechanacim;

    /**
     * Image file
     *
     * @var File
     *
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     maxSizeMessage = "The maxmimum allowed file size is 5MB.",
     *     mimeTypesMessage = "Only the filetypes image are allowed."
     * )
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cedula", type="string", length=10)
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string")
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50)
     */
    private $username;
    
	/**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     */
    private $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="Credito", mappedBy="userCredFk")
     */
    private $creditos;

    /**
     * @ORM\OneToMany(targetEntity="Reserva", mappedBy="usuResFk")
     */
    private $Reservas;
	private $roles;
    
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Usuario
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return Usuario
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }
	
    /**
     * Set fechanacim
     *
     * @param \DateTime $fechanacim
     *
     * @return Usuario
     */
    public function setFechanacim($fechanacim)
    {
    	$this->fechanacim = $fechanacim;
    
    	return $this;
    }
    
    /**
     * Get fechanacim
     *
     * @return \DateTime
     */
    public function getFechanacim()
    {
    	return $this->fechanacim;
    }
    
    /**
     * Set foto
     *
     * @param string $foto
     *
     * @return Usuario
     */
    public function setFoto($foto)
    {
    	$this->foto = $foto;
    
    	return $this;
    }
    
    /**
     * Get foto
     *
     * @return string
     */
    public function getFoto()
    {
    	return $this->foto;
    }
    
    
    
    /**
     * Set cedula
     *
     * @param integer $cedula
     *
     * @return Usuario
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return int
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Usuario
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
     * Set telefono
     *
     * @param integer $telefono
     *
     * @return Usuario
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return int
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set username
     *
     * @param string $username
     *
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
    
    public function getPlainPassword()
    {
    	return $this->plainPassword;
    }
    
    public function setPlainPassword($password)
    {
    	$this->plainPassword = $password;
    }
    
    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->creditos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Reservas = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add credito
     *
     * @param \AppBundle\Entity\Credito $credito
     *
     * @return Usuario
     */
    public function addCredito(\AppBundle\Entity\Credito $credito)
    {
        $this->creditos[] = $credito;

        return $this;
    }

    /**
     * Remove credito
     *
     * @param \AppBundle\Entity\Credito $credito
     */
    public function removeCredito(\AppBundle\Entity\Credito $credito)
    {
        $this->creditos->removeElement($credito);
    }

    /**
     * Get creditos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCreditos()
    {
        return $this->creditos;
    }

    /**
     * Add reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     *
     * @return Usuario
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
	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getRoles()
	 */
	public function getRoles() {
		return array('ROLE_USER');

	}

	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getSalt()
	 */
	public function getSalt() {
		
	}


	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\UserInterface::eraseCredentials()
	 */
	public function eraseCredentials() {
		// TODO: Auto-generated method stub

	}
	
}
