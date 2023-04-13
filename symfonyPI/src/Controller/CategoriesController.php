<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\User;
use App\Form\CategoriesType;
use App\Entity\Services;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityRepository;
use App\Repository\CategoriesRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;


#[Route('/categories')]
class CategoriesController extends AbstractController
{
    #[Route('/', name: 'app_categories_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $categories = $entityManager
            ->getRepository(Categories::class)
            ->findAll();

        return $this->render('categories/index.html.twig', [
            'categories' => $categories,
        ]);
    }


    #[Route('/listedescategories/{idService}', name: 'app_categories_listecategories', methods: ['GET'])]
    public function index1(EntityManagerInterface $em, $idService ): Response
    {
        
       
        $qb = $em->createQueryBuilder();
        $qb->select('c')
            ->from(Categories::class, 'c')
            ->join(Services::class, 's', 'WITH', 'c.idService = s')
            ->where('s.idService = :serviceId')
            ->setParameter('serviceId', $idService);

            

            $categories = $qb->getQuery()->getResult();
      

        return $this->render('categories/listecategories.html.twig', [
            'categories' => $categories,
            
        ]);
    }


    #[Route('/trie', name: 'trier_categorie', methods: ['GET'])]
    public function trier_services(EntityManagerInterface $em)
    {
       
        
        $qb = $em->createQueryBuilder();
        $qb->select('s')
                 ->from('App\Entity\Categories', 's')
                 ->orderBy('s.nbTotService', 'DESC');

                 $query = $qb->getQuery();
                 $categories = $query->getResult();

       
        return $this->render('categories/index.html.twig', [
            'categories' => $categories,
        ]);
    }


    #[Route('/calculeservice', name: 'count_categorie_by_id', methods: ['GET'])]
    public function countServicesByIdAction(EntityManagerInterface $em)
    {
        
        $count = $em->createQueryBuilder()
        ->select('COUNT(s)')
        ->from('App\Entity\Categories', 's')
        ->getQuery()
        ->getSingleScalarResult();

        return new Response('Le nombre de categories totale dans notre plateforme TN-JOB  :' . $count);
    }

    #[Route('/categoriedetail/{idCategorie}', name: 'app_categories_categoriedetail', methods: ['GET'])]
    public function index2(EntityManagerInterface $entityManager , $idCategorie): Response
    {
        $categories = $entityManager
            ->getRepository(Categories::class)
            ->find($idCategorie);
        

            $freelancers = $entityManager
            ->getRepository(User::class)
            ->findAll();
        return $this->render('categories/categoriedetail.html.twig', [
            'categories' => $categories,
            'freelancers' => $freelancers,

        ]);
    }


    


    #[Route('/admin', name: 'admin')]
    public function indexadmin(): Response
    {
        
            
            

        return $this->render('thamer/thamer1.html.twig');
    }

    #[Route('/new', name: 'app_categories_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $category = new Categories();
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($category);
            $entityManager->flush();

            return $this->redirectToRoute('app_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categories/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{idCategorie}', name: 'app_categories_show', methods: ['GET'])]
    public function show(Categories $category): Response
    {
        return $this->render('categories/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/{idCategorie}/edit', name: 'app_categories_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Categories $category, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoriesType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_categories_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categories/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/{idCategorie}', name: 'app_categories_delete', methods: ['POST'])]
    public function delete(Request $request, Categories $category, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getIdCategorie(), $request->request->get('_token'))) {
            $entityManager->remove($category);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_categories_index', [], Response::HTTP_SEE_OTHER);
    }

   
}
