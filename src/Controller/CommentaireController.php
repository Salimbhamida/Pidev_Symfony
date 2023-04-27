<?php

namespace App\Controller;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Entity\Reclamation;
use App\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Repository\CommentaireRepository;
use App\Repository\ReclamationRepository;


use Symfony\Component\Validator\Constraints\DateTime;
class CommentaireController extends AbstractController
{ 
    #[Route('/commentaire', name: 'app_commentaire')]
    public function index(): Response
    {   
     
        return $this->render('commentaire/index.html.twig', [
            'controller_name' => 'CommentaireController',
        ]);
    }


    #[Route('/addcom/{id}', name: 'form_Com')]
    public function Addcommentaire(HttpFoundationRequest $request, ManagerRegistry $doctrine,$id): Response
    {  
        $repository= $doctrine->getRepository(Commentaire::class);
        $rep= $doctrine->getRepository(Reclamation::class);
        $rec= $rep->find($id);
      $commentaire=new Commentaire;
      $form=$this->createForm(CommentaireType::class, $commentaire);
     // $form->add('add', SubmitType::class);
      $form->handleRequest($request);
      
      if ($form->isSubmitted() && $form->isValid())
      {
        $date = new \DateTime();
        $commentaire->setDateC($date);
        $commentaire->setReclamation($rec);
        $em=$doctrine->getManager();
        $em->persist($commentaire);
        $repository->sms('+21653515237',$commentaire->getDescriptionC(),$commentaire->getDateC());
        $em->flush();
        return $this->redirectToRoute('list_com');
      }
      return $this->renderForm('commentaire/addcom.html.twig',['formCom'=>$form,'commentaire' => $commentaire]);

        }

        #[Route('/listcom', name: 'list_com')]
        public function listc(ManagerRegistry $doctrine): Response
        {
            $repository= $doctrine->getRepository(Commentaire::class);
            $commentaires=$repository->findAll();
            return $this->render('commentaire/listcom.html.twig', [
                'commentaire' => $commentaires,
            ]);
        }
    
    
    
           #[Route('/delete_com/{id}', name: 'delete_Com')]
            public function Deletecommentaire(ManagerRegistry $doctrine, $id): Response
            {
                $repository= $doctrine->getRepository(Commentaire::class);
                $commentaire=$repository->find($id);
                $em= $doctrine->getManager();
                $em->remove($commentaire);
                $em->flush();
                return $this->redirectToRoute('list_com');
            } 
    
    
            #[Route('/updateCom/{id}', name: 'updateCommentaire')]
            public function updateCommentaire(ManagerRegistry $doctrine , HttpFoundationRequest $req ,$id )
            {
            $repository= $doctrine->getRepository(Commentaire::class);
            $commentaires=$repository->find($id);
             $form = $this-> createForm(CommentaireType::class,$commentaires);
             //$form->add('modify', SubmitType::class);
             $form->handleRequest($req);
             if($form->isSubmitted() )
             {
            
                $em = $doctrine->getManager();
                $em->flush();
                return $this->redirectToRoute('list_com');
             
             }
        
            return $this->renderForm("Commentaire/editcom.html.twig",['formCom'=>$form,'commentaires'=>$commentaires]);
            }

}

