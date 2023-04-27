<?php

namespace App\Controller;

use App\Entity\Poste;
use App\Form\PosteType;
use App\Repository\DemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Snappy\Pdf;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;

#[Route('/poste')]
class PosteController extends AbstractController
{
    #[Route('/', name: 'app_poste_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $postes = $entityManager
            ->getRepository(Poste::class)
            ->findAll();

        return $this->render('poste/index.html.twig', [
            'postes' => $postes,
        ]);
    }

    #[Route('/new/{idDemande}', name: 'app_poste_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,$idDemande , DemandeRepository $repo,NotifierInterface $notifier): Response
    {
        $poste = new Poste();
        $Demande=$repo->findById($idDemande);
        $poste->setIdDemande($Demande);
        $form = $this->createForm(PosteType::class, $poste);
        $form->handleRequest($request);
            //
        $myDictionary = array(
            "chien", "chat", "elephant","girafe",
            
            "souris"
        );
        dump($request);
        //

        if ($form->isSubmitted() && $form->isValid()) {


            //
            $myText = $request->get("poste")['description'];
            
            $badwords = new BadWordsController();
            $badwords->setDictionaryFromArray($myDictionary)->setText($myText);
            $check = $badwords->check();
            dump($check);
            
                if ($check){
                    $notifier->send(new Notification('Mauvais mot ', ['browser']));} 
                else {

                    $entityManager->persist($poste);
                    $entityManager->flush();

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER); 
        }


        }

        return $this->renderForm('poste/new.html.twig', [
            'poste' => $poste,
            'form' => $form,'demande_pst' => $Demande,
        ]);
    }

    #[Route('/{idPoste}', name: 'app_poste_show', methods: ['GET'])]
    public function show(Poste $poste): Response
    {
        return $this->render('poste/show.html.twig', [
            'poste' => $poste,
        ]);
    }

    #[Route('/{idPoste}/edit', name: 'app_poste_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Poste $poste, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PosteType::class, $poste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_poste_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('poste/edit.html.twig', [
            'poste' => $poste,
            'form' => $form,
        ]);
    }

    #[Route('/{idPoste}', name: 'app_poste_delete', methods: ['POST'])]
    public function delete(Request $request, Poste $poste, EntityManagerInterface $entityManager): Response
    {
        
            $entityManager->remove($poste);
            $entityManager->flush();
        

        return $this->redirectToRoute('app_poste_index', [], Response::HTTP_SEE_OTHER);
    }



    #[Route('/home/generate-pdf/{idDemande}', name: 'app_generate_pdf', methods: ['GET'])]
    public function generatePdfAction(Pdf $pdf,EntityManagerInterface $entityManager, $idDemande , DemandeRepository $demanderep)
    {


        $demandes = $demanderep->findById($idDemande);

        // Fetch data from database or any other source
        $data = array(
            'title' => 'www.TN-JOB.tn',
            'content' => 'demande details',
            'demandes' => $demandes,
            // Add other data to pass to the view
        );

        // Render the Twig template as HTML
        $html = $this->renderView('poste/pdf.html.twig', $data);

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
