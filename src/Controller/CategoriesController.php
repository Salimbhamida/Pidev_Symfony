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
use Symfony\Component\HttpFoundation\JsonResponse;
use Dompdf\Dompdf;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;

use Endroid\QrCode\Label\Font\NotoSans;
use Swift_Mailer;
use Swift_Message;

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

  
    #[Route('/pdfcat', name: 'pdf')]
public function generatePdf(Request $request , EntityManagerInterface $entityManager): Response
{
    $desc = $request->request->get('desc');


    $imagePath = file_get_contents('assets/logo.jpg');
        $imgData = base64_encode($imagePath);
        $imgSrc = 'data:image/jpeg;base64,' . $imgData;
   



    $nomcategorie='thamer';
    $date = date('d/m/Y'); 
    $queryBuilder = $entityManager->createQueryBuilder();
    $queryBuilder->select('s')
        ->from('App\Entity\User', 's')
        ->where('s.username LIKE :nomcategorie')
        ->setParameter('nomcategorie', '%' . $nomcategorie . '%');

    $categories = $queryBuilder->getQuery()->getSingleResult();
    
    
    $html = '
        <html>
        <head>
            <style>
            body {
                font-family: Arial, sans-serif;
                font-size: 16px;
                line-height: 1.5;
                color: #333;
                background-color: #fff;
            }
        
            .blue-title {
                color: blue;
                font-size: 28px;
                font-weight: bold;
                margin-top: 0;
            }
        
            .red-title {
                color: red;
                font-size: 40px;
                font-weight: bold;
                margin-top: 0;
            }
        
            .subtitle {
                font-size: 24px;
                font-weight: bold;
                margin-top: 20px;
            }
        
            img {
                max-width: 100%;
                height: auto;
                margin-bottom: 20px;
            }
        
            .recruiter-info {
                margin-top: 20px;
                font-size: 18px;
            }
        
            .recruiter-info p {
                margin: 10px 0;
            }
        
            .date {
                font-size: 16px;
                font-style: italic;
                margin-top: 20px;
            }
                .blue-title {
                    color: blue;
                    font-size: 24px;
                }
                .red-title {
                    color: red;
                    font-size: 36px;
                }
                .subtitle {
                    font-size: 18px;
                }
                
            </style>
        </head>
        <body>
        <div>Date: '.$date.'</div> 
        <img src="' . $imgSrc . '" />
            <img src="" alt="Image description">
            <center>
            <h1 class="red-title">Reservation Freelancer</h1>
            <h2 class="blue-title">Application tn-job</h2>
            <h3 class="subtitle">Description de la tâche</h3>
            </center>
            <div>'.$desc.'</div>
            <div> <p> le recruteur: <p> </div>
            <p> nom recruteur :</p>
                <div>'.$categories->getusername().'</div>
                <p> email recruteur :</p>
                <div>'.$categories->getemail().'</div>
            <div>Date: '.$date.'</div> 
           
        </body>
        </html>';

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $pdfContent = $dompdf->output();
    $response = new Response();
    $response->setContent($pdfContent);
    $response->headers->set('Content-Type', 'application/pdf');

    $disposition = $response->headers->makeDisposition(
        ResponseHeaderBag::DISPOSITION_ATTACHMENT,
        'reservation.pdf'
    );
    $response->headers->set('Content-Disposition', $disposition);

    return $response;
}




    #[Route('/mailcat', name: 'mail')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        

      
        $email = (new Email())
            ->from('tn-job-plateforme@gmail.com')
            ->to('freelancerthamer@example.com')
            ->subject('Reservation freelancer')
     
            ->html('<p>bonjour je souhaite de te reserver pour une tache dev mobile salaire 1000d , cordiallement</p>');
            //->attachFromPath('C:\Users\lenovo\Desktop\tn-job-desc1.pdf', 'res.pdf')
        
        $mailer->send($email);
        

        

        return $this->redirectToRoute('app_services_front', [], Response::HTTP_SEE_OTHER);
    }










    
/*
    #[Route('/qr-codes', name: 'app_qr_codes'  )]
    public function qrcode(Request $request)
    {
        $desc = $request->request->get('desc');

        $writer = new PngWriter();
   
        $qrCode = QrCode::create('qr')
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(120)
            ->setMargin(0)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
      
        $label = Label::create('bonjour')->setFont(new NotoSans(8));
 
        $qrCodes = [];
       
        $qrCodes['simple'] = $writer->write(
                                $qrCode,
                                null,
                                $label->setText('QR-code reservation')
                            )->getDataUri();
 
        return $this->render('categories/qr.html.twig', $qrCodes );
    }

*/
   




    #[Route('/recherche/categorie', name: 'recherchecategorie' )]
    public function rechercheService(request $request, EntityManagerInterface $entityManager)
    {
        $nomcategorie = $request->request->get('nomcategorie');

        
        $queryBuilder = $entityManager->createQueryBuilder();
        $queryBuilder->select('s')
            ->from('App\Entity\Categories', 's')
            ->where('s.nomCategorie LIKE :nomcategorie')
            ->setParameter('nomcategorie', '%' . $nomcategorie . '%');

        $categories = $queryBuilder->getQuery()->getResult();

        $categoriesArray = [];
        foreach ($categories as $categorie) {
            $categoriesArray[] = [
                'id' => $categorie->getIdCategorie(),
                'nomcategorie' => $categorie->getNomCategorie(),
                'nbtotfreelance' => $categorie->getNbTotService()
            ];
        }

        $response = new JsonResponse(['categories' => $categoriesArray]);
        
        return $response;
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
    public function index2(EntityManagerInterface $entityManager , $idCategorie , Request $request): Response
    {
        $categories = $entityManager
            ->getRepository(Categories::class)
            ->find($idCategorie);
        

            $freelancers = $entityManager
            ->getRepository(User::class)
            ->findAll();



            $desc = $request->request->get('desc');
/*
            $writer = new PngWriter();
       
            $qrCode = QrCode::create('ggg')
                ->setEncoding(new Encoding('UTF-8'))
                ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
                ->setSize(120)
                ->setMargin(0)
                ->setForegroundColor(new Color(0, 0, 0))
                ->setBackgroundColor(new Color(255, 255, 255));
          
            $label = Label::create('bonjour')->setFont(new NotoSans(8));
     
           
           
            $simple = $writer->write(
                                    $qrCode,
                                    null,
                                    $label->setText('QR-code reservation')
                                )->getDataUri();  */
     





    

        
        return $this->render('categories/categoriedetail.html.twig', [
            'categories' => $categories,
            'freelancers' => $freelancers,
           // 'simple' => $simple,
            

        ] );
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

