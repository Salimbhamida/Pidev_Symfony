<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\DemandeType;
use App\Repository\PosteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/demande')]
class DemandeController extends AbstractController
{
    #[Route('/', name: 'app_demande_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $demandes = $entityManager
            ->getRepository(Demande::class)
            ->findAll();

        
    



        return $this->render('demande/index.html.twig', [
            'demandes' => $demandes,
        ]);
    }


   

    #[Route('/new', name: 'app_demande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {
        $demande = new Demande();
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($demande);
            $entityManager->flush();

            ///
            $email = (new Email())
            ->from('tn-job@gmail.com')
            ->to('mohammedkhalil.tebessi@esprit.tn')
            ->subject('validation de la demande d emploi')
            ->text('votre demande est bien deposée, merci d utiliser notre platforme tn-job')
            ->html('votre demande est bien deposée. Voici de votre demande au nom de '.$demande->getNomRecruteur().'  <br> description :'.$demande->getDescription().'<br> experience :'.$demande->getExperience().' ans <br> remuneration : '.$demande->getRemuneration().'<br> Merci d\'utiliser notre plateforme tn-job.');

            $mailer->send($email);




            ///

            return $this->redirectToRoute('app_demande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demande/new.html.twig', [
            'demande' => $demande,
            'form' => $form,
        ]);
    }

    #[Route('/{idDemande}', name: 'app_demande_show', methods: ['GET'])]
    public function show(Demande $demande,$idDemande,PosteRepository $repoP): Response
    {
        $postes=$repoP->findPosteByDemande($idDemande);

        return $this->render('demande/show.html.twig', [
            'demande' => $demande,'postes' => $postes,
        ]);
    }

    #[Route('/{idDemande}/edit', name: 'app_demande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Demande $demande, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_demande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demande/edit.html.twig', [
            'demande' => $demande,
            'form' => $form,
        ]);
    }

    #[Route('/{idDemande}', name: 'app_demande_delete', methods: ['POST'])]
    public function delete(Request $request, Demande $demande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demande->getIdDemande(), $request->request->get('_token'))) {
            $entityManager->remove($demande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demande_index', [], Response::HTTP_SEE_OTHER);
    }
    
}
