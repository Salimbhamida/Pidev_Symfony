<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PubLikeTracks
 *
 * @ORM\Table(name="pub_like_tracks")
 * @ORM\Entity
 */
class PubLikeTracks
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pub", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPub;

    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer", nullable=false)
     */
    private $idUser;

    public function getIdPub(): ?int
    {
        return $this->idPub;
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


}
