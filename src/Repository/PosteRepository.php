<?php

namespace App\Repository;


use App\Entity\Poste;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Classroom>
 *
 * @method Poste|null find($id, $lockMode = null, $lockVersion = null)
 * @method Poste|null findOneBy(array $criteria, array $orderBy = null)
 * @method Poste[]    findAll()
 * @method Poste[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PosteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Poste::class);
    }

    public function findPosteByDemande($idDemande): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.idDemande = :value')
            ->setParameter('value', $idDemande)
            ->getQuery()
            ->getResult();
    }

    public function countPostesParDemande($idDemande)
{
    $qb = $this->createQueryBuilder('p')
        ->select('COUNT(p.idPoste)')
        ->where('p.idDemande = :idDemande')
        ->setParameter('idDemande', $idDemande);

    return $qb->getQuery()->getSingleScalarResult();
}
}