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
  public function freelancer(): ?int
  {
    return $this->createQueryBuilder('u')
      ->select('count(u.id)')
      ->where('u.role=:value')
      ->setParameter('value', 'freelancer')
      ->getQuery()
      ->getSingleScalarResult();
  }
  public function recruteur(): ?int
  {
    return $this->createQueryBuilder('u')
      ->select('count(u.id)')
      ->where('u.role=:value')
      ->setParameter('value', 'recruteur')
      ->getQuery()
      ->getSingleScalarResult();
  }
  public function candidat(): ?int
  {
    return $this->createQueryBuilder('u')
      ->select('count(u.id)')
      ->where('u.role=:value')
      ->setParameter('value', 'candidat')
      ->getQuery()
      ->getSingleScalarResult();
  }
  public function fetchUsers($val): array
  {
    return $this->createQueryBuilder('u')
      ->where('u.id LIKE :value')
      ->orWhere('u.username LIKE :value')
      ->orWhere('u.email LIKE :value')
      ->orWhere('u.role  LIKE :value')
      ->setParameter('value', '%' . $val . '%')
      ->getQuery()
      ->getResult();
  }
}
