<?php

namespace App\Controller;

use Amp\Http\Client\Request;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RouteController extends AbstractController
{
  #[Route('/index', name: 'app_route')]
  public function index(): Response
  {
    return $this->render('/index.html.twig', [
      'controller_name' => 'RouteController',
    ]);
  }

  #[Route('/tn-jobs/Home', name: 'Main')]
  public function Main(): Response
  {
    return $this->render('/frontBase.html.twig', [
      'controller_name' => 'RouteController',
    ]);
  }
  #[Route('/tn-jobs/profile/{id}', name: 'Profile')]
  public function Profile(User $user): Response
  {
    return $this->render('user/profile.html.twig', [
      'controller_name' => 'RouteController',
      'user' => $user,
    ]);
  }
}
