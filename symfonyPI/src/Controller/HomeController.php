<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Repository\DemandeRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    


    #[Route('/home', name: 'app_home', methods: ['GET', 'POST'])]
    public function demandes(EntityManagerInterface $entityManager, DemandeRepository $demandeRepository, Request $request): Response
    {
        // recherche avancée
        $form = $this->createFormBuilder()
            ->add('searchedby', TextType::class)
            ->add('search', SubmitType::class)
            ->getForm();
    
        $form->handleRequest($request);
    
        // trier les demandes 
        $sortForm = $this->createFormBuilder()
            ->add('sortby', ChoiceType::class, [
                'choices' => [
                    'Name' => 'nomRecruteur',
                    'Experience' => 'experience',
                    'Remuneration' => 'remuneration'
                ],
                'placeholder' => 'Sort by',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('sortorder', ChoiceType::class, [
                'choices' => [
                    'Ascending' => 'asc',
                    'Descending' => 'desc'
                ],
                'placeholder' => 'Sort order',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('sort', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary'
                ]
            ])
            ->getForm();
    
        $sortForm->handleRequest($request);
                        // tester le formulaire de la recherche avancé
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $searchTerm = strtolower($data['searchedby']);
    
            $queryBuilder = $demandeRepository->createQueryBuilder('d')
                ->where('LOWER(d.nomRecruteur) LIKE :searchTerm')
                ->orWhere('LOWER(d.description) LIKE :searchTerm')
                ->orWhere('LOWER(d.experience) LIKE :searchTerm')
                ->orWhere('LOWER(d.remuneration) LIKE :searchTerm')
                ->orWhere('LOWER(d.telephone) LIKE :searchTerm')
                ->setParameter('searchTerm', '%' . $searchTerm . '%');
    
            $query = $queryBuilder->getQuery();
            $demandes = $query->getResult();
        } else {
            $demandes = $entityManager
                ->getRepository(Demande::class)
                ->findAll();
        }
                        // tester le formulaire de la tri
        if ($sortForm->isSubmitted() && $sortForm->isValid()) {
            $data = $sortForm->getData();
            $sortby = $data['sortby'];
            $sortorder = $data['sortorder'];
    
            $queryBuilder = $demandeRepository->createQueryBuilder('d')
                ->orderBy("d.$sortby", $sortorder);
    
            $query = $queryBuilder->getQuery();
            $demandes = $query->getResult();
        }
    
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'sortForm' => $sortForm->createView(),
            'demandes' => $demandes,
        ]);
    } 



}
