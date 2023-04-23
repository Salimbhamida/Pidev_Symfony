<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
  #[Route('/tn-jobs/mailer', name: 'app_mailer')]
  public function index(MailerInterface $mailer): Response
  {
    $email = (new TemplatedEmail())
      ->from('tn-jobs@gmail.com')
      ->to('you@example.com')
      //->cc('cc@example.com')
      //->bcc('bcc@example.com')
      ->subject('Time for Symfony Mailer!')
      ->htmlTemplate('mailer/index.html.twig')
      ->context([
        'name' => 'salim'
      ]);
    $mailer->send($email);

    $mailer->send($email);
    return $this->render('mailer/index.html.twig', [
      'name' => 'MailerController',
    ]);
  }
}
