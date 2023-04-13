<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Services
 *
 * @ORM\Table(name="services")
 * @ORM\Entity
 */
class Services
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_service", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idService;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_service", type="string", length=20, nullable=false)
     */
    private $nomService;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_tot_freelance", type="integer", nullable=false)
     */
    private $nbTotFreelance;

    public function getIdService(): ?int
    {
        return $this->idService;
    }

    public function getNomService(): ?string
    {
        return $this->nomService;
    }

    public function setNomService(string $nomService): self
    {
        $this->nomService = $nomService;

        return $this;
    }

    public function getNbTotFreelance(): ?int
    {
        return $this->nbTotFreelance;
    }

    public function setNbTotFreelance(int $nbTotFreelance): self
    {
        $this->nbTotFreelance = $nbTotFreelance;

        return $this;
    }


}
