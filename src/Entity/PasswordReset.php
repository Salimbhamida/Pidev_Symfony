<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasswordReset
 *
 * @ORM\Table(name="password-reset")
 * @ORM\Entity
 */
class PasswordReset
{
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=30, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=60, nullable=false)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="created_at", type="string", length=30, nullable=false)
     */
    private $createdAt;

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


}
