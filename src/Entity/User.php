<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
//use Symfony\Component\Validator\Mapping\ClassMetadata;

/**
 * 
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(
 * fields={"email"} ,
 * message="L'email existe deja !"
 * )
 */
class User implements UserInterface
{
    public function __construct()
    {
        //parent::__construct();
        $this->autoriser = false;
    }
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     * 
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min ="4", minMessage= "votre mot de passe doit prendre au moins 4 caracteres")
     */
    private $password;

    /**
     * @Assert\EqualTo(propertyPath="password", message="Saissiez le meme mot de passe")
     */

    public $confirm_password; 

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];


    private $username;
    
     /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255 )
     */
    private $telephone;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $autoriser;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAutoriser(): ?bool
    {
        return $this->autoriser;
    }

    public function setAutoriser(bool $autoriser): self
    {
        $this->autoriser = $autoriser;

        return $this;
    }

    public function eraseCredentials(){}
   
    public function getSalt(){}

    public function setRoles(array $roles): self
    {
        $this -> roles = $roles;
        return $this;
    }
    
    public function getRoles()
    {
        $roles = $this -> roles;
        $roles[] = 'ROLE_USER';
        return array_unique($roles); 
    }
    
    public function getUsername(){}
    public function setUsername(){}
    public function setEnabled(){}
    public function setPlainPassword(){}
    
}
