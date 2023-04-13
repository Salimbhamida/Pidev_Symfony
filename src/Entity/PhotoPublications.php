<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PhotoPublications
 *
 * @ORM\Table(name="photo_publications")
 * @ORM\Entity
 */
class PhotoPublications
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_ph", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPh;

    /**
     * @var int
     *
     * @ORM\Column(name="id_pub", type="integer", nullable=false)
     */
    private $idPub;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=100, nullable=false)
     */
    private $lien;

    public function getIdPh(): ?int
    {
        return $this->idPh;
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

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }


}
