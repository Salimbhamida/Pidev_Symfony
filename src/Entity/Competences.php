<?php

namespace App\Entity;

use InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetenceRepository;
 
#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
class Competences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int  $idComp=null;

    #[ORM\Column(length:100)]
    
    private ?string $nom;

    public function getIdComp(): ?int
    {
        return $this->idComp;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {

        $regex = '/^[a-zA-Z\s]*$/';
    if (strlen($nom) > 50 || !preg_match($regex, $nom)) {
        throw new \InvalidArgumentException('Le nom est invalide.');
    }

        $this->nom = $nom;

        return $this;
    }


}
