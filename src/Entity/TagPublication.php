<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TagPublication
 *
 * @ORM\Table(name="tag_publication")
 * @ORM\Entity
 */
class TagPublication
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_tag", type="integer", nullable=true)
     */
    private $idTag;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_pub", type="integer", nullable=true)
     */
    private $idPub;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdTag(): ?int
    {
        return $this->idTag;
    }

    public function setIdTag(?int $idTag): self
    {
        $this->idTag = $idTag;

        return $this;
    }

    public function getIdPub(): ?int
    {
        return $this->idPub;
    }

    public function setIdPub(?int $idPub): self
    {
        $this->idPub = $idPub;

        return $this;
    }


}
