<?php

namespace App\Controller;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ReclamationController extends AbstractController
{
    #[Route('/reclamation', name: 'app_reclamation')]
    public function index(): Response
    {
        return $this->render('reclamation/index.html.twig', [
            'controller_name' => 'ReclamationController',
        ]);
    }

    #[Route('/addrec', name: 'form_C')]
    public function Addreclamation(HttpFoundationRequest $request, ManagerRegistry $doctrine): Response
    {  
        $repository= $doctrine->getRepository(Reclamation::class);

      $reclamation=new Reclamation;
      $form=$this->createForm(ReclamationType::class, $reclamation);
      $form->add('add', SubmitType::class);
      $form->handleRequest($request);
      
      if ($form->isSubmitted() && $form->isValid())
      {
        $em=$doctrine->getManager();
        $em->persist($reclamation);
        $em->flush();
        return $this->redirectToRoute('list_rec');
      }
      return $this->renderForm('reclamation/addrec.html.twig',['formC'=>$form,'reclamation' => $reclamation]);

        }

        #[Route('/listrec', name: 'list_rec')]
    public function listc(ManagerRegistry $doctrine): Response
    {
        $repository= $doctrine->getRepository(Reclamation::class);
        $reclamations=$repository->findAll();
        return $this->render('reclamation/listrec.html.twig', [
            'reclamation' => $reclamations,
        ]);
    }


       #[Route('/delete/{id}', name: 'delete_C')]
        public function Deletereclamation(ManagerRegistry $doctrine, $id): Response
        {
            $repository= $doctrine->getRepository(Reclamation::class);
            $reclamation=$repository->find($id);
            $em= $doctrine->getManager();
            $em->remove($reclamation);
            $em->flush();
            return $this->redirectToRoute('list_rec');
        } 


        #[Route('/updateRec/{id}', name: 'updateReclmation')]
        public function updateReclamation(ManagerRegistry $doctrine , HttpFoundationRequest $req ,$id )
        {
        $repository= $doctrine->getRepository(Reclamation::class);
        $reclamations=$repository->find($id);
         $form = $this-> createForm(ReclamationType::class,$reclamations);
         $form->add('modify', SubmitType::class);
         $form->handleRequest($req);
         if($form->isSubmitted() )
         {
        
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('list_rec');
         
         }
    
        return $this->renderForm("reclamation/editrec.html.twig",['formC'=>$form,'reclamations'=>$reclamations]);
        }
}


