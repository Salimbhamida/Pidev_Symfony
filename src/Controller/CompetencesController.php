<?php

namespace App\Controller;


use App\Entity\Competences;
use App\Form\CompetencesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;



#[Route('/competences')]
class CompetencesController extends AbstractController
{
    #[Route('/', name: 'app_competences_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $competences = $entityManager
            ->getRepository(Competences::class)
            ->findAll();

        return $this->render('competences/index.html.twig', [
            'competences' => $competences,
        ]);
    }

    #[Route('/new', name: 'app_competences_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {   

        $competence = new Competences();
        $form = $this->createForm(CompetencesType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($competence);
            $entityManager->flush();

            return $this->redirectToRoute('app_competences_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('competences/new.html.twig', [
            'competence' => $competence,
            'form' => $form,
        ]);
    }

    #[Route('/{idComp}', name: 'app_competences_show', methods: ['GET'])]
    public function show(Competences $competence): Response
    {
        return $this->render('competences/show.html.twig', [
            'competence' => $competence,
        ]);
    }

    #[Route('/{idComp}/edit', name: 'app_competences_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Competences $competence, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompetencesType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_competences_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('competences/edit.html.twig', [
            'competence' => $competence,
            'form' => $form,
        ]);
    }

    #[Route('/{idComp}', name: 'app_competences_delete', methods: ['POST'])]
    public function delete(Request $request, Competences $competence, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competence->getIdComp(), $request->request->get('_token'))) {
            $entityManager->remove($competence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_competences_index', [], Response::HTTP_SEE_OTHER);
    }
}
