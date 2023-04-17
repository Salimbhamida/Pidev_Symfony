<?php

namespace App\Controller;

use App\Entity\Scolarite;
use App\Form\ScolariteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/scolarite')]
class ScolariteController extends AbstractController
{
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
        $form = $this->createForm(ScolariteType::class, $scolarite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($scolarite);
            $entityManager->flush();

            return $this->redirectToRoute('app_scolarite_index', [], Response::HTTP_SEE_OTHER);
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
}
