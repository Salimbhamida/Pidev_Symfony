<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ThamerController extends AbstractController
{
    #[Route('/thamer', name: 'app_thamer')]
    public function index(): Response
    {
        return $this->render('thamer/index.html.twig', [
            'controller_name' => 'ThamerController',
        ]);
    }
}
