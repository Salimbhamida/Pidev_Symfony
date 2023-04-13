<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categories
 *
 * @ORM\Table(name="categories", indexes={@ORM\Index(name="fk_services_categories", columns={"id_service"})})
 * @ORM\Entity
 */
class Categories
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_categorie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCategorie;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_categorie", type="string", length=20, nullable=false)
     */
    private $nomCategorie;

    /**
     * @var int
     *
     * @ORM\Column(name="nb_tot_service", type="integer", nullable=false)
     */
    private $nbTotService;

    /**
     * @var \Services
     *
     * @ORM\ManyToOne(targetEntity="Services")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_service", referencedColumnName="id_service")
     * })
     */
    private $idService;

    public function getIdCategorie(): ?int
    {
        return $this->idCategorie;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): self
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    public function getNbTotService(): ?int
    {
        return $this->nbTotService;
    }

    public function setNbTotService(int $nbTotService): self
    {
        $this->nbTotService = $nbTotService;

        return $this;
    }

    public function getIdService(): ?Services
    {
        return $this->idService;
    }

    public function setIdService(?Services $idService): self
    {
        $this->idService = $idService;

        return $this;
    }


}
