<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Integer;

class UserRepository extends ServiceEntityRepository
{
  public function __construct(ManagerRegistry $registry)
  {
    parent::__construct($registry, User::class);
  }
  public function countUsers(): ?int
  {
    return $this->createQueryBuilder('u')
      ->select('count(u.id)')
      ->getQuery()
      ->getSingleScalarResult();
  }
}
