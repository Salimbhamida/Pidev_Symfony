<?php

namespace App\Entity;

use InvalidArgumentException;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ExperienceRepository;



#[ORM\Entity(repositoryClass: ExperienceRepository::class)]
class Experiences
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]

    private ?int $idExp=null;


    #[ORM\Column(length:255)]
    
    private ?string $nomEntreprise;


    #[ORM\Column(length:255)]
    
    private ?string  $poste;

 
     #[ORM\Column(type:'date')]
     #[Assert\LessThanOrEqual("today")]
    private ?\DateTime $dateDebut;


    #[ORM\Column(type:'date')]
    
    private ?\DateTime $dateFin;

    

    public function getIdExp(): ?int
    {
        return $this->idExp;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nomEntreprise;
    }

    public function setNomEntreprise(string $nomEntreprise): self
    {   
        $regex = '/^[a-zA-Z0-9\s\-]*$/';
    if (strlen($nomEntreprise) > 100 || !preg_match($regex, $nomEntreprise)) {
        throw new \InvalidArgumentException('Le nom de l\'entreprise est invalide.');
    }

        $this->nomEntreprise = $nomEntreprise;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->poste;
    }

    public function setPoste(string $poste): self
    {
        $regex = '/^[a-zA-Z0-9\s\-]*$/';
        if (strlen($poste) > 100 || !preg_match($regex, $poste)) {
            throw new \InvalidArgumentException('Le nom de poste est invalide.');
        }
        $this->poste = $poste;

        return $this;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTime $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTime
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTime $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }


}
