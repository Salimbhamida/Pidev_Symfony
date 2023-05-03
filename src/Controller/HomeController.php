<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Repository\DemandeRepository;
use App\Repository\PosteRepository;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Snappy\Pdf;
use Knp\Component\Pager\PaginatorInterface;


class HomeController extends AbstractController
{



    #[Route('/home', name: 'app_home', methods: ['GET', 'POST'])]
    public function demandes(EntityManagerInterface $entityManager, DemandeRepository $demandeRepository, PosteRepository $posteRepository, Request $request, PaginatorInterface $paginator): Response
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
                    'Remuneration' => 'remuneration',

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
            $demandes = $paginator->paginate(
                $query, // Requête contenant les données à paginer
                $request->query->getInt('page', 1), // Numéro de la page en cours, 1 par défaut
                20
            ); // Nombre de résultats par page
        }


        // tester le formulaire de la tri
        else if ($sortForm->isSubmitted() && $sortForm->isValid()) {
            $data = $sortForm->getData();
            $sortby = $data['sortby'];
            $sortorder = $data['sortorder'];



            $queryBuilder = $demandeRepository->createQueryBuilder('d')
                ->orderBy("d.$sortby", $sortorder);


            $query = $queryBuilder->getQuery();
            $demandes =  $paginator->paginate(
                $query, // Requête contenant les données à paginer
                $request->query->getInt('page', 1), // Numéro de la page en cours, 1 par défaut
                20
            ); // Nombre de résultats par page
        } else {

            $queryBuilder = $demandeRepository->createQueryBuilder('d');
            $query = $queryBuilder->getQuery();
            $demandes =  $paginator->paginate(
                $query, // Requête contenant les données à paginer
                $request->query->getInt('page', 1), // Numéro de la page en cours, 1 par défaut
                4
            );
        }



        $postesParDemande = [];
        foreach ($demandes as $demande) {
            $postesParDemande[$demande->getIdDemande()] =  $posteRepository->countPostesParDemande($demande->getIdDemande());
        }







        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'sortForm' => $sortForm->createView(),
            'demandes' => $demandes,
            'postesParDemande' => $postesParDemande,
        ]);
    }






    #[Route('/home/generate-pdf', name: 'app_generate_pdf', methods: ['GET'])]
    public function generatePdfAction(Pdf $pdf, EntityManagerInterface $entityManager)
    {


        $demandes = $entityManager
            ->getRepository(Demande::class)
            ->findAll();

        

        // Fetch data from database or any other source
        $data = array(
            'title' => 'PDF Generated using Snappy Bundle',
            'content' => 'This PDF file is generated using the Snappy Bundle in Symfony.',
            'demandes' => $demandes,
            
            // Add other data to pass to the view
        );

        // Render the Twig template as HTML
        $html = $this->renderView('home/pdf.html.twig', $data);

        // Generate the PDF file from the HTML content
        $pdf->setOption('margin-top', '10mm');
        $pdf->setOption('margin-bottom', '10mm');
        $pdf->setOption('margin-left', '10mm');
        $pdf->setOption('margin-right', '10mm');
        $pdf->setOption('page-size', 'A4');
        $pdf->setOption('orientation', 'Portrait');
        $pdf->setOption('encoding', 'UTF-8');

        $pdfContent = $pdf->getOutputFromHtml($html);

        // Generate the response containing the PDF file
        $response = new Response($pdfContent);
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment;filename="file.pdf"');

        return $response;
    }
}
