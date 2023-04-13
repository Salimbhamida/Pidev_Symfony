<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commentair
 *
 * @ORM\Table(name="commentair")
 * @ORM\Entity
 */
class Commentair
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_com", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCom;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=50, nullable=false)
     */
    private $username;

    /**
     * @var int
     *
     * @ORM\Column(name="id_pub", type="integer", nullable=false)
     */
    private $idPub;

    /**
     * @var string
     *
     * @ORM\Column(name="suj_com", type="string", length=255, nullable=false)
     */
    private $sujCom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_com", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $dateCom = 'CURRENT_TIMESTAMP';

    /**
     * @var int
     *
     * @ORM\Column(name="nb_reaction", type="integer", nullable=false)
     */
    private $nbReaction;

    public function getIdCom(): ?int
    {
        return $this->idCom;
    }

    public function getIdUser(): ?int
    {
        return $this->idUser;
    }

    public function setIdUser(int $idUser): self
    {
        $this->idUser = $idUser;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getIdPub(): ?int
    {
        return $this->idPub;
    }

    public function setIdPub(int $idPub): self
    {
        $this->idPub = $idPub;

        return $this;
    }

    public function getSujCom(): ?string
    {
        return $this->sujCom;
    }

    public function setSujCom(string $sujCom): self
    {
        $this->sujCom = $sujCom;

        return $this;
    }

    public function getDateCom(): ?\DateTimeInterface
    {
        return $this->dateCom;
    }

    public function setDateCom(\DateTimeInterface $dateCom): self
    {
        $this->dateCom = $dateCom;

        return $this;
    }

    public function getNbReaction(): ?int
    {
        return $this->nbReaction;
    }

    public function setNbReaction(int $nbReaction): self
    {
        $this->nbReaction = $nbReaction;

        return $this;
    }


}
