<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="fk_comm_user", columns={"id_reclamation"})})
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_c", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idC;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_c", type="date", nullable=false)
     */
    private $dateC;

    /**
     * @var string
     *
     * @ORM\Column(name="description_c", type="string", length=200, nullable=false)
     */
    private $descriptionC;

    /**
     * @var \Reclamation
     *
     * @ORM\ManyToOne(targetEntity="Reclamation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_reclamation", referencedColumnName="id_reclamation")
     * })
     */
    private $idReclamation;

    public function getIdC(): ?int
    {
        return $this->idC;
    }

    public function getDateC(): ?\DateTimeInterface
    {
        return $this->dateC;
    }

    public function setDateC(\DateTimeInterface $dateC): self
    {
        $this->dateC = $dateC;

        return $this;
    }

    public function getDescriptionC(): ?string
    {
        return $this->descriptionC;
    }

    public function setDescriptionC(string $descriptionC): self
    {
        $this->descriptionC = $descriptionC;

        return $this;
    }

    public function getIdReclamation(): ?Reclamation
    {
        return $this->idReclamation;
    }

    public function setIdReclamation(?Reclamation $idReclamation): self
    {
        $this->idReclamation = $idReclamation;

        return $this;
    }


}
