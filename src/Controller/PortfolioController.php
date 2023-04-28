<?php

namespace App\Controller;


use App\Entity\Competences;
use App\Entity\Experiences;
use App\Entity\Scolarite;
use App\Entity\User;
use App\Entity\Photo;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/portfolio')]
class PortfolioController extends AbstractController
{
    #[Route('/', name: 'app_portfolio_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $competences = $entityManager->getRepository(Competences::class)->findAll();
        $experiences = $entityManager->getRepository(Experiences::class)->findAll();
        $scolarites = $entityManager->getRepository(Scolarite::class)->findAll();
        $photo = $entityManager->getRepository(Photo::class)->findAll();
        $user = $entityManager->getRepository(User::class)->findAll();

        return $this->render('portfolio/index.html.twig', [
            'competences' => $competences,
            'experiences' => $experiences,
            'scolarites' => $scolarites,
            'user' => $user,
            'photos' => $photo,

        ]);
    }
    
    #[Route('/visit', name: 'visit_index', methods: ['GET'])]
    public function visit(EntityManagerInterface $entityManager): Response
    {
        $competences = $entityManager->getRepository(Competences::class)->findAll();
        $experiences = $entityManager->getRepository(Experiences::class)->findAll();
        $scolarites = $entityManager->getRepository(Scolarite::class)->findAll();
        $photo = $entityManager->getRepository(Photo::class)->findAll();
        $user = $entityManager->getRepository(User::class)->findAll();

        return $this->render('portfolio/profile.html.twig', [
            'competences' => $competences,
            'experiences' => $experiences,
            'scolarites' => $scolarites,
            'user' => $user,
            'photos' => $photo,

        ]);
    }
}