<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Demande
 *
 * @ORM\Table(name="demande", indexes={@ORM\Index(name="fk_recruteur_user", columns={"id_recruteur"})})
 * @ORM\Entity
 */
class Demande
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_demande", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDemande;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_recruteur", type="string", length=30, nullable=false)
     */
    private $nomRecruteur;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="experience", type="integer", nullable=false)
     */
    private $experience;

    /**
     * @var float
     *
     * @ORM\Column(name="remuneration", type="float", precision=6, scale=2, nullable=false)
     */
    private $remuneration;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", nullable=false)
     */
    private $telephone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiration", type="date", nullable=false)
     */
    private $expiration;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_recruteur", referencedColumnName="id")
     * })
     */
    private $idRecruteur;


}
