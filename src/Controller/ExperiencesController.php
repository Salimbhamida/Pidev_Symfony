<?php

namespace App\Controller;

use App\Entity\Experiences;
use App\Form\ExperiencesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/experiences')]
class ExperiencesController extends AbstractController
{
    #[Route('/', name: 'app_experiences_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $experiences = $entityManager
            ->getRepository(Experiences::class)
            ->findAll();

        return $this->render('experiences/index.html.twig', [
            'experiences' => $experiences,
        ]);
    }

    #[Route('/new', name: 'app_experiences_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $experience = new Experiences();
        $form = $this->createForm(ExperiencesType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($experience);
            $entityManager->flush();

            return $this->redirectToRoute('app_experiences_new', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('experiences/new.html.twig', [
            'experience' => $experience,
            'form' => $form,
        ]);
    }

    #[Route('/{idExp}', name: 'app_experiences_show', methods: ['GET'])]
    public function show(Experiences $experience): Response
    {
        return $this->render('experiences/show.html.twig', [
            'experience' => $experience,
        ]);
    }

    #[Route('/{idExp}/edit', name: 'app_experiences_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Experiences $experience, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExperiencesType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_experiences_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('experiences/edit.html.twig', [
            'experience' => $experience,
            'form' => $form,
        ]);
    }

    #[Route('/{idExp}', name: 'app_experiences_delete', methods: ['POST'])]
    public function delete(Request $request, Experiences $experience, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$experience->getIdExp(), $request->request->get('_token'))) {
            $entityManager->remove($experience);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_experiences_index', [], Response::HTTP_SEE_OTHER);
    }
}
