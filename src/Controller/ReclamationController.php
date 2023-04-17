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
use Symfony\Component\Validator\Constraints\DateTime;

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
      //$form->add('add', SubmitType::class);
      $form->handleRequest($request);
      
      if ($form->isSubmitted() && $form->isValid())
      {
        $date = new \DateTime();
        $reclamation->setDate($date);
        $em=$doctrine->getManager();
        $em->persist($reclamation);
        $em->flush();
        return $this->redirectToRoute('form_C');
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
            return $this->redirectToRoute('form_C');
        } 


        #[Route('/updateRec/{id}', name: 'updateReclmation')]
        public function updateReclamation(ManagerRegistry $doctrine , HttpFoundationRequest $req ,$id )
        {
        $repository= $doctrine->getRepository(Reclamation::class);
        $reclamations=$repository->find($id);
         $form = $this-> createForm(ReclamationType::class,$reclamations);
         //$form->add('modify', SubmitType::class);
         $form->handleRequest($req);
         if($form->isSubmitted() )
         {
            $date = new \DateTime();
            $reclamations->setDate($date);
            $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('form_C');
         
         }
    
        return $this->renderForm("reclamation/editrec.html.twig",['formC'=>$form,'reclamations'=>$reclamations]);
        }


        #[Route('/getRec/{id}', name: 'getrecid')]
    public function show_id(ManagerRegistry $doctrine,ManagerRegistry $doc, $id): Response
    {


        $repository = $doctrine->getRepository(Reclamation::class);
        $reclamations = $repository->find($id);
        

        $commentaire= $reclamations->getCommentaires();
        return $this->render('reclamation/detailrec.html.twig', [
            'Reclamation' => $reclamations,
            'commentaire'  => $commentaire,
       
        ]);
    }

}


