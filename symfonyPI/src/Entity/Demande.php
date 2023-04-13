<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
    #[Assert\NotBlank(message: "the name of the recruter is required")]
    private $nomRecruteur;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    #[Assert\NotBlank(message: "description is required")]
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="experience", type="integer", nullable=false)
     */
    #[Assert\NotBlank(message: "experience is required")]
    #[Assert\Positive(message: "experience must be a positive number")]
    private $experience;

    /**
     * @var float
     *
     * @ORM\Column(name="remuneration", type="float", precision=6, scale=2, nullable=false)
     */
    #[Assert\NotBlank(message: "remuneration is required")]
    #[Assert\Positive(message: "remuneration must be a positive number")]
    private $remuneration;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    #[Assert\NotBlank(message: "telephone number is required")]
    #[Assert\Length(min: 8,max: 8, exactMessage: "The telephone number must be exactly {{ limit }} digits long.")]
    private $telephone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiration", type="date", nullable=false)
     */
    #[Assert\NotBlank(message: "expiration date is required")]
    #[Assert\GreaterThanOrEqual(value: "today", message: "Expiration date must be superior of today's date")]
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function getRemuneration(): ?float
    {
        return $this->remuneration;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function getExpiration(): ?DateTime
    {
        return $this->expiration;
    }

   /**
     * Get the value of idCandidat
     *
     * @return \User
     */
    public function getIdRecruteur()
    {
        return $this->idRecruteur;
    }



    public function setNomRecruteur(string $nomRecruteur): self
    {
        $this->nomRecruteur = $nomRecruteur;

        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function setRemuneration(float $remuneration): self
    {
        $this->remuneration = $remuneration;

        return $this;
    }


    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function setExpiration(DateTime $expiration): self
    {
        $this->expiration = $expiration;

        return $this;
    }


    public function setIdRecruteur(User $idRecruteur): self
    {
        $this->idRecruteur = $idRecruteur;

        return $this;
    }







}
