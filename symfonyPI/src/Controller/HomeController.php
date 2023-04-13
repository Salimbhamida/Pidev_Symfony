<?php

namespace App\Controller;

use App\Entity\Demande;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    


    #[Route('/home', name: 'app_home', methods: ['GET'])]
    public function demandes(EntityManagerInterface $entityManager): Response
    {
        $demandes = $entityManager
            ->getRepository(Demande::class)
            ->findAll();

        return $this->render('home/index.html.twig', [
            'demandes' => $demandes,
        ]);
    }



}
