<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use PhpParser\Node\Expr\Cast\String_;
use Symfony\Component\Validator\Constraints as Assert; 

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
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z]+$/",
     *     message="Le champ ne doit contenir que des lettres alphabétiques."
     * )
     *    @ORM\Column(type="string" , length=20)
     */
    #[Assert\NotBlank]
    private $nomService;

    /**
     * @Assert\Range(
     *      min = 0,
     *      max = 100,
     *      notInRangeMessage = "La valeur doit être comprise entre {{ min }} et {{ max }}",
     * )
     *  @ORM\Column(name="nb_tot_freelance", type="integer", nullable=false)
     */
    #[Assert\NotBlank]
    private $nbTotFreelance;

    public function getIdservice(): ?int
    {
        return $this->idService;
    }

    public function getNbTotFreelance(): ?int
    {
        return $this->nbTotFreelance;
    }

    public function getNomService(): ?String
    {
        return $this->nomService;
    }

    public function setNomService(string $nomService): self
    {
        $this->nomService = $nomService;

        return $this;
    }

    public function setNbTotFreelance(int $nbTotFreelance): self
    {
        $this->nbTotFreelance = $nbTotFreelance;

        return $this;
    }

}
