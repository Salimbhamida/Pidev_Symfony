<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\ServicesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityRepository;
use App\Repository\CategoriesRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\RememberMe\ResponseListener;

#[Route('/services')]
class ServicesController extends AbstractController
{
    #[Route('/', name: 'app_services_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $services = $entityManager
            ->getRepository(Services::class)
            ->findAll();

        return $this->render('services/index.html.twig', [
            'services' => $services,
        ]);
    }

    #[Route('/calculeservice', name: 'count_services_by_id', methods: ['GET'])]
    public function countServicesByIdAction(EntityManagerInterface $em)
    {
       
        

       
        $count = $em->createQueryBuilder()
        ->select('COUNT(s)')
        ->from('App\Entity\Services', 's')
        ->getQuery()
        ->getSingleScalarResult();

       
        return new Response('Le nombre de services totale de notre plateforme TN-JOB est   :' . $count );
    }

    #[Route('/recherche/service', name: 'rechercheService' )]
    public function rechercheService(request $request, EntityManagerInterface $entityManager)
    {
        $nomservice = $request->request->get('nomservice');

        
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('s')
            ->from('App\Entity\Services', 's')
            ->where('s.nomService LIKE :nomservice')
            ->setParameter('nomservice', '%' . $nomservice . '%');

        $services = $queryBuilder->getQuery()->getResult();

        $servicesArray = [];
        foreach ($services as $service) {
            $servicesArray[] = [
                'id' => $service->getIdservice(),
                'nomservice' => $service->getNomService(),
                'nbtotfreelance' => $service->getNbTotFreelance()
            ];
        }

        $response = new JsonResponse(['services' => $servicesArray]);
        
        return $response;
    }


   



    #[Route('/trie', name: 'trier_services', methods: ['GET'])]
    public function trier_services(EntityManagerInterface $em)
    {
       
        
        $qb = $em->createQueryBuilder();
        $qb->select('s')
                 ->from('App\Entity\Services', 's')
                 ->orderBy('s.nbTotFreelance', 'DESC');

                 $query = $qb->getQuery();
                 $services = $query->getResult();

       
        return $this->render('services/index.html.twig', [
            'services' => $services,
        ]);
    }



    #[Route('/listeservices', name: 'app_services_front', methods: ['GET'])]
    public function index1(EntityManagerInterface $entityManager): Response
    {
        $services = $entityManager
            ->getRepository(Services::class)
            ->findAll();

        return $this->render('services/serviceFront.html.twig', [
            'services' => $services,
        ]);
    }


    #[Route('/new', name: 'app_services_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $service = new Services();
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('services/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{idService}', name: 'app_services_show', methods: ['GET'])]
    public function show(Services $service): Response
    {
        return $this->render('services/show.html.twig', [
            'service' => $service,
        ]);
    }

    #[Route('/{idService}/edit', name: 'app_services_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Services $service, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ServicesType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
                


            $entityManager->flush();

            return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('services/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{idService}', name: 'app_services_delete', methods: ['POST'])]
    public function delete(Request $request, Services $service, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getIdService(), $request->request->get('_token'))) {
            $entityManager->remove($service);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_services_index', [], Response::HTTP_SEE_OTHER);
    }


   

    
}

