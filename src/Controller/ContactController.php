<?php

namespace App\Controller;

use App\Form\ContactType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'contact')]
    public function index(MailerInterface $mailer, Request $request,): Response
    {



        $form = $this->createForm(ContactType::class);
        // Récupération des infos du formulaire quand il est envoyé
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();

            // Constitution d'un email
            $message = (new Email())
               ->from($formData['mail'])
               ->to('jeremy.demeulenaere59120@gmail.com')
               ->subject('Nouveau message de' .$formData['lastName'])->text($formData['message']);

            //Envoi du mail
            $mailer->send($message);
            // Gestion des erreurs

           $this->addFlash('success', 'Message envoyé !');

        }

        return $this->render('contact/index.html.twig',[
        'form'=>$form->createView(),


        ]);
    }
}

