<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Poste
 *
 * @ORM\Table(name="poste", indexes={@ORM\Index(name="poste_ibfk_1", columns={"id_demande"}), @ORM\Index(name="fk_user_poste", columns={"id_candidat"})})
 * @ORM\Entity
 */
class Poste
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_poste", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPoste;

    /**
     * @var int
     *
     * @ORM\Column(name="experience", type="integer", nullable=false)
     */
    private $experience;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=200, nullable=false)
     */
    private $description;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_candidat", referencedColumnName="id")
     * })
     */
    private $idCandidat;

    /**
     * @var \Demande
     *
     * @ORM\ManyToOne(targetEntity="Demande")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_demande", referencedColumnName="id_demande")
     * })
     */
    private $idDemande;

    public function getIdPoste(): ?int
    {
        return $this->idPoste;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIdCandidat(): ?User
    {
        return $this->idCandidat;
    }

    public function setIdCandidat(?User $idCandidat): self
    {
        $this->idCandidat = $idCandidat;

        return $this;
    }

    public function getIdDemande(): ?Demande
    {
        return $this->idDemande;
    }

    public function setIdDemande(?Demande $idDemande): self
    {
        $this->idDemande = $idDemande;

        return $this;
    }


}
