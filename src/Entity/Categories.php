<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert; 
use App\Repository\ClassroomRepository;

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
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z]+$/",
     *     message="Le champ ne doit contenir que des lettres alphabétiques."
     * )
     *   @ORM\Column(type="string" , length=20)
     */
    #[Assert\NotBlank]
    private $nomCategorie;

     /**
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      notInRangeMessage = "La valeur doit être comprise entre {{ min }} et {{ max }}",
     * )
     * @ORM\Column(name="nb_tot_service", type="integer", nullable=false)
     */
    #[Assert\NotBlank]
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

    public function getNbTotService(): ?int
    {
        return $this->nbTotService;
    }

    public function getNomCategorie(): ?String 
    {
        return $this->nomCategorie;
    }

    /**
     * Get the value of idService
     *
     * @return \Services
     */
    public function getIdService()
    {
        return $this->idService;
    }

    public function setNomCategorie(?string $nomCategorie): self
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    public function setNbTotService(?int $nbTotService): self
    {
        $this->nbTotService = $nbTotService;

        return $this;
    }

    public function setIdService(Services $idService): self
    {
        $this->idService = $idService;

        return $this;
    }


}
