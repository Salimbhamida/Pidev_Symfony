<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="fk_recruteur_user", columns={"id_recruteur"})})
 * @ORM\Entity
 */
class Demande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_demande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_recruteur", type="string", length=30, nullable=false)
     */
    private $nomRecruteur;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="experience", type="integer", nullable=false)
     */
    private $experience;

    /**
     * @var float
     *
     * @ORM\Column(name="remuneration", type="float", precision=6, scale=2, nullable=false)
     */
    private $remuneration;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiration", type="date", nullable=false)
     */
    private $expiration;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_recruteur", referencedColumnName="id")
     * })
     */
    private $idRecruteur;

    public function getIdDemande(): ?int
    {
        return $this->idDemande;
    }

    public function getNomRecruteur(): ?string
    {
        return $this->nomRecruteur;
    }

    public function setNomRecruteur(string $nomRecruteur): self
    {
        $this->nomRecruteur = $nomRecruteur;

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

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getRemuneration(): ?float
    {
        return $this->remuneration;
    }

    public function setRemuneration(float $remuneration): self
    {
        $this->remuneration = $remuneration;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getExpiration(): ?\DateTimeInterface
    {
        return $this->expiration;
    }

    public function setExpiration(\DateTimeInterface $expiration): self
    {
        $this->expiration = $expiration;

        return $this;
    }

    public function getIdRecruteur(): ?User
    {
        return $this->idRecruteur;
    }

    public function setIdRecruteur(?User $idRecruteur): self
    {
        $this->idRecruteur = $idRecruteur;

        return $this;
    }


}
