<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Form\ReclamationType;
use App\Repository\ReclamationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Knp\Component\Pager\PaginatorInterface;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;


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
  public function Addreclamation(HttpFoundationRequest $request, ManagerRegistry $doctrine, NotifierInterface $notifier): Response
  {
    $repository = $doctrine->getRepository(Reclamation::class);

    $reclamation = new Reclamation();
    $form = $this->createForm(ReclamationType::class, $reclamation);
    //$form->add('add', SubmitType::class);
    $form->handleRequest($request);

    $myDictionary = array(
      "louz", "kloub", "homs", "bondok",

      "kakawia"
    );
    dump($request); {
      if ($form->isSubmitted() && $form->isValid()) {
        $date = new \DateTime();
        $reclamation->setDate($date);

        $myText = $request->get("reclamation")['description'];

        $badwords = new PhpBadWordsController();
        $badwords->setDictionaryFromArray($myDictionary)
          ->setText($myText);
        $check = $badwords->check();
        dump($check);
        if ($check) {

          $this->addFlash('error', 'vous avez saisie un badword - veillez saisir un nouvelle reclamation');
          return $this->renderForm('reclamation/addrec.html.twig', ['formC' => $form, 'reclamation' => $reclamation]);
        } else {

          $em = $doctrine->getManager();
          $em->persist($reclamation);
          $em->flush();
          return $this->redirectToRoute('form_C');
        }
      }
      $this->addFlash('info', 'vous avez une nouvelle reclamation');
      return $this->renderForm('reclamation/addrec.html.twig', ['formC' => $form, 'reclamation' => $reclamation]);
    }
  }

  #[Route('/listrec', name: 'list_rec')]
  public function listc(Request $request, ReclamationRepository $reclamationRepository, PaginatorInterface $paginator): Response
  {
    $form = $this->createFormBuilder()
      ->add('searchedby', TextType::class, [
        'required' => false
      ])
      ->add('search', SubmitType::class)
      ->getForm();

    $form->handleRequest($request);
    if ($form->isSubmitted() && $form->isValid()) {
      $data = $form->getData();
      $searchTerm = strtolower($data['searchedby']);

      $queryBuilder = $reclamationRepository->createQueryBuilder('d');
      if ($searchTerm) {
        $queryBuilder->where('LOWER(d.id) LIKE :searchTerm')
          ->orWhere('LOWER(d.description) LIKE :searchTerm')
          ->setParameter('searchTerm', '%' . $searchTerm . '%');
      }

      $reclamations = $queryBuilder->getQuery()->getResult();
    } else {
      $reclamations = $reclamationRepository->findAll();
    }
    $reclamations = $paginator->paginate(
      $reclamations, /* query NOT result */
      $request->query->getInt('page', 1), /*page number*/
      5 /*limit per page*/
    );

    return $this->render('reclamation/listrec.html.twig', [
      'reclamation' => $reclamations,
      'form' => $form->createView()
    ]);
  }

  #[Route('/delete/{id}', name: 'delete_C')]
  public function Deletereclamation(ManagerRegistry $doctrine, $id): Response
  {
    $repository = $doctrine->getRepository(Reclamation::class);
    $reclamation = $repository->find($id);
    $em = $doctrine->getManager();
    $em->remove($reclamation);
    $em->flush();
    return $this->redirectToRoute('form_C');
  }


  #[Route('/updateRec/{id}', name: 'updateReclmation')]
  public function updateReclamation(ManagerRegistry $doctrine, HttpFoundationRequest $req, $id)
  {
    $repository = $doctrine->getRepository(Reclamation::class);
    $reclamations = $repository->find($id);
    $form = $this->createForm(ReclamationType::class, $reclamations);
    //$form->add('modify', SubmitType::class);
    $form->handleRequest($req);
    if ($form->isSubmitted()) {
      $date = new \DateTime();
      $reclamations->setDate($date);
      $em = $doctrine->getManager();
      $em->flush();
      return $this->redirectToRoute('form_C');
    }

    return $this->renderForm("reclamation/editrec.html.twig", ['formC' => $form, 'reclamations' => $reclamations]);
  }


  #[Route('/getRec/{id}', name: 'getrecid')]
  public function show_id(ManagerRegistry $doctrine, ManagerRegistry $doc, $id): Response
  {


    $repository = $doctrine->getRepository(Reclamation::class);
    $reclamations = $repository->find($id);


    $commentaire = $reclamations->getCommentaires();
    return $this->render('reclamation/detailrec.html.twig', [
      'Reclamation' => $reclamations,
      'commentaire'  => $commentaire,

    ]);
  }


  #[Route("/reclamation/deleteM", name: "supprimeM")]


  public function delete_mobile(Request $request, SerializerInterface $serializer, EntityManagerInterface $entityManager): Response
  {
    $id = $request->query->get("id");
    $entityManager = $this->getDoctrine()->getManager();
    $reclamationRepository = $entityManager->getRepository(Reclamation::class);
    $reclamation = $reclamationRepository->find($id);

    if ($reclamation !== null) {
      $entityManager->remove($reclamation);
      $entityManager->flush();
      $formatted = $serializer->serialize($reclamation, 'json');

      return new Response($formatted);
    }



    return new Response(" Reclamation does not exist ");
  }


  #[Route('/reclamation/afficheM', name: 'afficheMo')]
  public function show_mobile(ReclamationRepository $ReclamationRepository, SerializerInterface $serializerInterface)
  {
    $reclamation = $ReclamationRepository->findAll();
    $json = $serializerInterface->serialize($reclamation, 'json', ['groups' => 'reclamation']);

    return new JsonResponse($json, 200, [], true);
  }
}
