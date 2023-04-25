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


}
