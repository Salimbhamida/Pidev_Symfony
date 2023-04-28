<?php

namespace App\Entity;

use InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CompetenceRepository;
use Symfony\Component\Validator\Constraints as Assert;
 
#[ORM\Entity(repositoryClass: CompetenceRepository::class)]
class Competences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int  $idComp=null;

    #[ORM\Column(length:100)]
    #[Assert\NotBlank(message: "Le nom ne peut pas être vide")]
    #[Assert\Length(max:100, maxMessage:"Le nom ne peut pas dépasser {{ limit }} caractères")]

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

        $this->nom = $nom;

        return $this;
    }
    public function __toString() {
        return $this->getNom();
    }


}
