<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Entity\Poste;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back')]
class BackController extends AbstractController
{
    #[Route('/', name: 'back-index', methods: ['GET'])]
    public function index(): Response
    {
       
        return $this->render('backbase.html.twig',);
    }




    #[Route('/demande', name: 'back_demande', methods: ['GET'])]
    public function demandeBack(EntityManagerInterface $entityManager): Response
    {
        $demandes = $entityManager
            ->getRepository(Demande::class)
            ->findAll();

        return $this->render('back/demande.html.twig', [
            'demandes' => $demandes,
        ]);
    }

    #[Route('/poste', name: 'back_poste', methods: ['GET'])]
    public function posteBack(EntityManagerInterface $entityManager): Response
    {
        $postes = $entityManager
            ->getRepository(Poste::class)
            ->findAll();

        return $this->render('back/poste.html.twig', [
            'postes' => $postes,
        ]);
    }
    #[Route('/delete/post/{idPoste}', name: 'back_poste_delete', methods: ['POST', 'DELETE'])]
    public function deletePoste(Request $request, Poste $poste, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$poste->getIdPoste(), $request->request->get('_token'))) {
            $entityManager->remove($poste);
            $entityManager->flush();
        }
    
        return $this->redirectToRoute('back_poste', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/delete/demande/{idDemande}', name: 'back_demande_delete', methods: ['POST', 'DELETE'])]
    public function deleteDemande(Request $request, Demande $demande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demande->getIdDemande(), $request->request->get('_token'))) {
        $entityManager->remove($demande);
        $entityManager->flush();
        }

        return $this->redirectToRoute('back_demande', [], Response::HTTP_SEE_OTHER);
    }


}
