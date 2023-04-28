<?php

namespace App\Controller;

use App\Entity\Scolarite;
use App\Repository\ScolariteRepository;
use App\Form\ScolariteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;



#[Route('/scolarite')]
class ScolariteController extends AbstractController
{   
    #[Route('/pays-suggestions', name: 'app_pays_suggestions', methods: ['GET'])]
    public function paysSuggestions(Request $request): JsonResponse
    {
        $searchTerm = $request->query->get('q');

        // Replace this with your code to retrieve the list of suggestions based on the search term
        $suggestions = [
            ['id' => 'FR', 'text' => 'France'],
            ['id' => 'US', 'text' => 'United States'],
            ['id' => 'CA', 'text' => 'Canada'],
            // ...
        ];

        return $this->json(['results' => $suggestions]);
    }

    #[Route('/', name: 'app_scolarite_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $scolarites = $entityManager
            ->getRepository(Scolarite::class)
            ->findAll();

        return $this->render('scolarite/index.html.twig', [
            'scolarites' => $scolarites,
        ]);
    }

    #[Route('/new', name: 'app_scolarite_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $scolarite = new Scolarite();
        $form = $this->createForm(ScolariteType::class, $scolarite,[
        ]);
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($scolarite);
            $entityManager->flush();

            return $this->redirectToRoute('app_scolarite_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('scolarite/new.html.twig', [
            'scolarite' => $scolarite,
            'form' => $form,
        ]);
    }

    #[Route('/{idEtab}', name: 'app_scolarite_show', methods: ['GET'])]
    public function show(Scolarite $scolarite): Response
    {
        return $this->render('scolarite/show.html.twig', [
            'scolarite' => $scolarite,
        ]);
    }

    #[Route('/{idEtab}/edit', name: 'app_scolarite_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Scolarite $scolarite, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ScolariteType::class, $scolarite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_scolarite_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('scolarite/edit.html.twig', [
            'scolarite' => $scolarite,
            'form' => $form,
        ]);
    }

    #[Route('/{idEtab}', name: 'app_scolarite_delete', methods: ['POST'])]
    public function delete(Request $request, Scolarite $scolarite, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$scolarite->getIdEtab(), $request->request->get('_token'))) {
            $entityManager->remove($scolarite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_scolarite_index', [], Response::HTTP_SEE_OTHER);
    }

    // #[Route('/pays', name: 'app_pays', methods: ['GET'])]
    // public function findPays(ScolariteRepository $scolariteRepository, Request $requset ): Response
    // {
    //     $serached_term = $request->query->get('');
    //     dd($serached_term);
    //     $pays=$scolariteRepository->findByPays($serached_term);
    //     new Response('');
    // }
}
