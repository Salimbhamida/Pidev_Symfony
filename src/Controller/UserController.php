<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class UserController extends AbstractController
{
  #[Route('/tn-jobs/admin/list', name: 'app_user_index', methods: ['GET'])]
  public function index(EntityManagerInterface $entityManager): Response
  {
    $users = $entityManager
      ->getRepository(User::class)
      ->findAll();

    return $this->render('user/index.html.twig', [
      'users' => $users,
    ]);
  }

  #[Route('/tn-jobs/admin/new', name: 'app_user_new', methods: ['GET', 'POST'])]
  public function new(Request $request, EntityManagerInterface $entityManager): Response
  {
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $user->setRememberToken(rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '='));
      $entityManager->persist($user);
      $entityManager->flush();

      return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('user/new.html.twig', [
      'user' => $user,
      'form' => $form,
    ]);
  }

  #[Route('/tn-jobs/signIn', name: 'app_user_newSignIn', methods: ['GET', 'POST'])]
  public function newUser(Request $request, EntityManagerInterface $entityManager): Response
  {
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $user->setRememberToken(rtrim(strtr(base64_encode(random_bytes(32)), '+/', '-_'), '='));
      $entityManager->persist($user);
      $entityManager->flush();

      return $this->redirectToRoute('log', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('auth/signUp.html.twig', [
      'user' => $user,
      'form' => $form,
    ]);
  }

  #[Route('/tn-jobs/logIn', name: 'app_user_newlogIn')]
  public function logIn(EntityManagerInterface $em, Request $request): Response
  {
    $user = new User();
    $form = $this->createFormBuilder($user)
      ->add('email', null, [
        'attr' => ['class' => 'form-control', 'placeholder' => 'Email']
      ])
      ->add('password', PasswordType::class, [
        'attr' => ['class' => 'form-control', 'placeholder' => 'Password']
      ])
      ->getForm();
    $form->handleRequest($request);
    if ($form->isSubmitted()) {
      $query = $em->createQuery(' SELECT s FROM App\Entity\User s
WHERE s.email = :email ');
      $query->setParameter('email', $form->get('email')->getData());
      $user = $query->getResult();
      if (!empty($user))
        return $this->redirectToRoute('Main');
      else
        return $this->redirectToRoute('app_user_newlogIn');
    } else
      return $this->render('auth/logIn.html.twig', [
        'form' => $form->createView(),
      ]);
  }


  #[Route('/tn-jobs/admin/{id}', name: 'app_user_show', methods: ['GET'])]
  public function show(User $user): Response
  {
    return $this->render('user/show.html.twig', [
      'user' => $user,
    ]);
  }



  #[Route('/tn-jobs/admin/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
  public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
  {
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $entityManager->flush();

      return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('user/edit.html.twig', [
      'user' => $user,
      'form' => $form,
    ]);
  }

  #[Route('/tn-jobs/admin/{id}', name: 'app_user_delete', methods: ['POST'])]
  public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
  {
    if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
      $entityManager->remove($user);
      $entityManager->flush();
    }

    return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
  }
}
