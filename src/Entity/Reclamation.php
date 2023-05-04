<?php

namespace App\Entity;

use App\Repository\ReclamationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ReclamationRepository::class)
 */
class Reclamation
{
  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(type="integer")
   */
  private ?int $id = null;

  /**
   * @ORM\Column(type="date")
   */
  private ?\DateTimeInterface $date = null;

  /**
   * @ORM\Column(type="string", length=140)
   * @Assert\NotBlank(message="La description ne peut pas être vide")
   * @Assert\Length(
   *      min=12,
   *      max=140,
   *      minMessage="La description doit contenir au moins {{ limit }} caractères",
   *      maxMessage="La description ne peut pas dépasser {{ limit }} caractères"
   * )
   */
  private ?string $description = null;

  /**
   * @ORM\OneToMany(mappedBy="reclamation", targetEntity=Commentaire::class)
   */
  private Collection $commentaires;

  public function __construct()
  {
    $this->commentaires = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getDate(): ?\DateTimeInterface
  {
    return $this->date;
  }

  public function setDate(\DateTimeInterface $date): self
  {
    $this->date = $date;

    return $this;
  }

  public function getDescription(): ?string
  {
    return $this->description;
  }

  public function setDescription(string $description): self
  {
    $this->description = $description;

    return $this;
  }

  /**
   * @return Collection<int, Commentaire>
   */
  public function getCommentaires(): Collection
  {
    return $this->commentaires;
  }

  public function addCommentaire(Commentaire $commentaire): self
  {
    if (!$this->commentaires->contains($commentaire)) {
      $this->commentaires->add($commentaire);
      $commentaire->setReclamation($this);
    }

    return $this;
  }

  public function removeCommentaire(Commentaire $commentaire): self
  {
    if ($this->commentaires->removeElement($commentaire)) {
      // set the owning side to null (unless already changed)
      if ($commentaire->getReclamation() === $this) {
        $commentaire->setReclamation(null);
      }
    }

    return $this;
  }
}
