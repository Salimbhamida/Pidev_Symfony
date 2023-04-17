<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use App\Repository\CvRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CvRepository::class)]
class Cv
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id=null;

    #[ORM\Column( length:255)]
    
    private ?string $filename;

    #[ORM\Column(length:255)]

    private ?string $filetype;

    #[ORM\Column(nullable:false)]
    
    private ?int $filesize;

    #[ORM\Column(length:0)]
    
    private ?string $data;

    #[ORM\Column(nullable:false)]
    #[Assert\NotBlank()]
    #[Assert\File(
        maxSize : "1024k",
        mimeTypes : ['application/pdf', 'application/x-pdf', 'image/jpeg', 'image/png'],
        mimeTypesMessage :"Please upload a valid PDF, JPEG or PNG"
)]
    



    public function getId(): ?int
    {
        return $this->id;
    }


    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getFiletype(): ?string
    {
        return $this->filetype;
    }

    public function setFiletype(string $filetype): self
    {
        $this->filetype = $filetype;

        return $this;
    }

    public function getFilesize(): ?int
    {
        return $this->filesize;
    }

    public function setFilesize(int $filesize): self
    {
        $this->filesize = $filesize;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data): self
    {
        $this->data = $data;

        return $this;
    }


}
