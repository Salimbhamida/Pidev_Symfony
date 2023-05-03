<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
  #[Route('/tn-jobs/admin', name: 'Back')]
  public function admin(UserRepository $repository, EntityManagerInterface $entityManager): Response
  {
    $nb = $repository->countUsers();
    $users = $entityManager
      ->getRepository(User::class)
      ->findAll();
    $freelancer =
      $entityManager
      ->getRepository(User::class)
      ->freelancer();
    $recruteur
      =
      $entityManager
      ->getRepository(User::class)
      ->recruteur();
    $candidat
      = $entityManager
      ->getRepository(User::class)
      ->candidat();
    return $this->render('Dashboard/index.html.twig', [
      'nb_user' => $nb,
      'list' => $users,
      'freelancer' => $freelancer,
      'recruteur' => $recruteur,
      'candidat' => $candidat,

    ]);
  }
}
