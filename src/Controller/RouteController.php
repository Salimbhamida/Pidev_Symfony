<?php

namespace App\Controller;

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
  #[Route('/tn-jobs/admin', name: 'Back')]
  public function admin(): Response
  {
    return $this->render('/backBase.html.twig', [
      'controller_name' => 'RouteController',
    ]);
  }
}
