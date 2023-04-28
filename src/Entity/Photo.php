<?php

namespace App\Entity;

use InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PhotoRepository;
use Symfony\Component\Validator\Constraints as Assert;
 
#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
   
    private ?string $photo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getPhoto();
    }



}
