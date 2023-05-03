<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
  #[Route('/signIn', name: 'Sign')]
  public function SignIn(): Response
  {
    return $this->render('auth/signUp.html.twig', [
      'controller_name' => 'AuthController',
    ]);
  }
  #[Route('/logIn', name: 'log')]
  public function logIn(): Response
  {
    return $this->render('auth/login.html.twig', [
      'controller_name' => 'AuthController',
    ]);
  }
}
