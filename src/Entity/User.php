<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */

#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface
{
  public function __toString()
  {
    return $this->id;
  }
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", nullable=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="IDENTITY")
   * 
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="username", type="string", length=30, nullable=false)
   *
   */
  #[Assert\NotBlank(message: "Username is required")]
  private $username;

  /**
   * @var string
   *
   * @ORM\Column(name="email", type="string", length=30, nullable=false,unique=true)
   */
  #[Assert\NotBlank(message: "Email is required")]
  #[Assert\Email(message: "The email '{{value}}' is not a valid email")]

  private $email;

  /**
   * @var string
   *
   * @ORM\Column(name="password", type="string", length=60, nullable=false)
   */

  private $password;

  /**
   * @var string
   *
   * @ORM\Column(name="role", type="string", length=30, nullable=false)
   */
  #[Assert\NotBlank(message: "Role is required")]
  private $role;


  /**
   * @ORM\Column(type="json")
   */

  private $roles = [];



  /**
   * @var string
   *
   * @ORM\Column(name="remember_token", type="string", length=60, nullable=false)
   */
  private $rememberToken;

  /**
   * @var datetime
   *@Gedmo\Timestampable(on="create")
   * @ORM\Column(name="created_at", type="datetime", nullable=false)
   */
  private $createdAt;

  /**
   * @var datetime|null
   *@Gedmo\Timestampable(on="update")
   * @ORM\Column(name="updated_at", type="datetime", nullable=true)
   */
  private $updatedAt;



  public function getId(): ?int
  {
    return $this->id;
  }

  public function getUsername(): ?string
  {
    return $this->username;
  }

  public function setUsername(?string $username): self
  {
    $this->username = $username;

    return $this;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(?string $email): self
  {
    $this->email = $email;

    return $this;
  }

  public function getPassword(): ?string
  {
    return $this->password;
  }

  public function setPassword(?string $password): self
  {
    $this->password = $password;

    return $this;
  }

  public function getRole(): ?string
  {
    return $this->role;
  }

  public function setRole(string $role): self
  {
    $this->role = $role;

    return $this;
  }

  public function getRememberToken(): ?string
  {
    return $this->rememberToken;
  }

  public function setRememberToken(string $rememberToken): self
  {
    $this->rememberToken = $rememberToken;

    return $this;
  }

  public function getCreatedAt(): ?DateTime
  {
    return $this->createdAt;
  }

  public function setCreatedAt(DateTime $createdAt): self
  {
    $this->createdAt = $createdAt;

    return $this;
  }

  public function getUpdatedAt(): ?DateTime
  {
    return $this->updatedAt;
  }

  public function setUpdatedAt(?DateTime $updatedAt): self
  {
    $this->updatedAt = $updatedAt;

    return $this;
  }

  public function eraseCredentials()
  {
  }
  public function getUserIdentifier(): ?string
  {
    return (string)$this->email;
  }
  public function setRoles(array $roles): self
  {
    $this->roles = $roles;

    return $this;
  }
  public function getRoles(): array
  {
    $roles = $this->roles;
    // guarantee every user at least has ROLE_USER
    $roles[] = 'ROLE_USER';

    return array_unique($roles);
  }
  public function getSalt(): ?string
  {
    return null;
  }
}
