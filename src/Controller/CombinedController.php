<?php

namespace App\Controller;

use App\Entity\Experiences;
use App\Entity\Competences;
use App\Entity\Scolarite;
use App\Form\CombinedType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CombinedController extends AbstractController
{
    #[Route('/createProfile', name: 'app_combined' ,methods: ['GET', 'POST'])]
public function index(Request $request, EntityManagerInterface $entityManager): Response
{
    // create a new instance of each entity
    $experience = new Experiences();
    $competence = new Competences();
    $education = new Scolarite();

    // create the form with the entities
    $form = $this->createForm(CombinedType::class, [
        'experience' => $experience,
        'competence' => $competence,
        'education' => $education,
    ]);

    // handle form submission
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        // get the form data
        $data = $form->getData();

        // save the entities to the database
        
        if ($request->request->has('create')) {
            $entityManager->persist($data['experience']);
            $entityManager->persist($data['competence']);
            $entityManager->persist($data['education']);
            $entityManager->flush();
        }

        // redirect to the showProfile page
        return $this->redirectToRoute('app_combined_show',[], Response::HTTP_SEE_OTHER);
    }

    return $this->render('combined/index.html.twig', [
        
        'form' => $form->createView(),
    ]);
}
//
//

    #[Route('/showprofile', name: 'app_combined_show')]
    public function showProfile(EntityManagerInterface $entityManager): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $experiences = $entityManager->getRepository(Experiences::class)->findAll();
        $competences = $entityManager->getRepository(Competences::class)->findAll();
        $scolarite = $entityManager->getRepository(Scolarite::class)->findAll();

        return $this->render('combined/show.html.twig', [
            'experiences' => $experiences,
            'competences' => $competences,
            'scolarite' => $scolarite,
        ]);
    }
}
