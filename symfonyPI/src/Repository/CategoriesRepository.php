<?php

namespace App\Repository;
use App\Entity\Categories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class CategoryRepository extends \Doctrine\ORM\EntityRepository
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct($em, $em->getClassMetadata(Category::class));
    }

public function listcategorie($value): array
        
  {
       return $this->createQueryBuilder('s')
            
            ->addSelect('s')
            ->where('s.id=:value')
            ->setParameter('value', $value)
          
         
            ->getQuery()
            ->getResult()
            
        ;
    }




}