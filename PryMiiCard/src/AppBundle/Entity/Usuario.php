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
     * @Assert\NotBlank(message="Campo Nombre es requerido")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "EL nombre debe ser mayor {{ limit }} caracteres",
     *      maxMessage = "El nombre debe ser menor a {{ limit }} caracteres"
     * )
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * @var string
     * @Assert\NotBlank(message="Campo Apellido es requerido")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "El apellido debe ser mayor {{ limit }} caracteres",
     *      maxMessage = "El apellido debe ser menor a {{ limit }} caracteres"
     * )
     * @ORM\Column(name="apellido", type="string", length=50)
     */
    private $apellido;
    
    /**
     * @var \Date
     * @Assert\NotBlank(message="Campo Fecha es requerido")
     * @ORM\Column(name="fechanacim", type="date", nullable=false)
     */
    private $fechanacim;

    /**
     * Image file
     *
     * @var File
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"image/jpeg", "image/gif", "image/png"},
     *     maxSizeMessage = "Lo máximo permitido es 5MB",
     *     mimeTypesMessage = "Solo se permite los formatos: .jpg .gif .png"
     * )
     * @ORM\Column(name="foto", type="string", length=255, nullable=true)
     */
    private $foto;
    
    /**
     * @var string
     * @Assert\Length(
     *      min = 10,
     *      max = 10,
     *      minMessage = "La cedula debe ser mayor {{ limit }} caracteres",
     *      maxMessage = "La cedula deber ser menor a {{ limit }} caracteres"
     * )
     * @ORM\Column(name="cedula", type="string", length=10, unique=true, nullable=true)
     */
    private $cedula;

    /**
     * @var string
     * @Assert\NotBlank(message="Campo Email es requerido")
     *@Assert\Email(
     *     message = "Campo Email '{{ value }}' no es valido")
     * @Assert\Length(
     *      min = 10,
     *      max = 50,
     *      minMessage = "El Email debe ser mayor {{ limit }} caracteres",
     *      maxMessage = "El email deber ser menor a {{ limit }} caracteres"
     * )
     * @ORM\Column(name="email", type="string", length=100, unique=true)
     */
    private $email;

    /**
     * @var string
     * @Assert\Length(
     *      min = 6,
     *      max = 10,
     *      minMessage = "El telefono debe ser mayor {{ limit }} caracteres",
     *      maxMessage = "El telefono deber ser menor a {{ limit }} caracteres"
     * )
     * @ORM\Column(name="telefono", type="string", nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *@Assert\NotBlank(message="Campo Nombre de usuario es requerido")
     *@Assert\Length(
     *      min = 10,
     *      max = 50,
     *      minMessage = "El Nombre de usuario debe ser mayor {{ limit }} caracteres",
     *      maxMessage = "El Nombre de usuario  debe ser menor a {{ limit }} caracteres"
     * )
     * @ORM\Column(name="username", type="string", length=50, unique=true)
     */
    private $username;
    
	/**
     * @var string
     * @Assert\NotBlank(message="Campo Contraseña es requerido")
     * @Assert\Length(
     *      min = 8,
     *      max = 12,
     *      minMessage = "La contraseña debe ser mayor {{ limit }} caracteres",
     *      maxMessage = "La contraseña debe ser menor a {{ limit }} caracteres")
     */
    private $plainPassword;

    /**
     * @var string
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
    private $reservas;

    /**
     * @ORM\Column(name="estCat", type="smallint")
     * */
    private $estado;//1=activo 0=inactivo
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
        $this->reservas = new \Doctrine\Common\Collections\ArrayCollection();
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
        $this->reservas[] = $reserva;

        return $this;
    }

    /**
     * Remove reserva
     *
     * @param \AppBundle\Entity\Reserva $reserva
     */
    public function removeReserva(\AppBundle\Entity\Reserva $reserva)
    {
        $this->reservas->removeElement($reserva);
    }

    /**
     * Get reservas
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservas()
    {
        return $this->reservas;
    }

	/**
	 * {@inheritDoc}
	 * @see \Symfony\Component\Security\Core\User\UserInterface::getRoles()
	 */
	public function getRoles() {

	    if($this->getEstado()==1)
		    return array('ROLE_USER');
	    else
	        return array('ROLE_ANONYMOUS');

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
    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Usuario
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

	public function getPathFoto(){
		return 'uploads/'.$this->getFoto();
	}
	
}
