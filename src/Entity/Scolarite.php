<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ScolariteRepository;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: ScolariteRepository::class)]
class Scolarite
{   
     #[ORM\Id]
     #[ORM\GeneratedValue]
     #[ORM\Column]

    private ?int $idEtab=null;

    
    #[ORM\Column(length:11)]
    #[Assert\NotBlank]
    #[Assert\Length(max:100)]

    private ?string $nomEtablissement=null;

 
    #[ORM\Column(length:30)]
    #[Assert\NotBlank]
    #[Assert\Length(max:30)]
    
    private  ?string  $ville=null;


    #[ORM\Column(length:30)]
    #[Assert\NotBlank]
    #[Assert\Length(max:30)]

    private  ?string $pays=null;


    #[ORM\Column(length:50)]
    #[Assert\NotBlank]
    #[Assert\Length(max:50)]

    private  ?string $diplome=null;

    #[ORM\Column()]
    #[Assert\NotBlank]
    #[Assert\LessThanOrEqual("today")]
    
    private ?\DateTime $dateObtention;

    public function getIdEtab(): ?int
    {
        return $this->idEtab;
    }

    public function getNomEtablissement(): ?string
    {
        return $this->nomEtablissement;
    }

    public function setNomEtablissement(string $nomEtablissement): self
    {

        $this->nomEtablissement = $nomEtablissement;



        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {

        $this->ville = $ville;


        return $this;
    }

    public function getPays(): ?string
    {
        return $this->pays;
    }

    public function setPays(string $pays): self
    {
        
        $this->pays = $pays;


        return $this;
    }

    public function getDiplome(): ?string
    {
        return $this->diplome;
    }

    public function setDiplome(string $diplome): self
    {
        $this->diplome = $diplome;

        return $this;
    }

    public function getDateObtention(): ?\DateTime
    {
        return $this->dateObtention;
    }

    public function setDateObtention(\DateTime $dateObtention): self
    {
        $this->dateObtention = $dateObtention;

        return $this;
    }


}
