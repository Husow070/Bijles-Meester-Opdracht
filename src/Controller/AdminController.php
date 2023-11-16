<?php

namespace App\Controller;

use App\Entity\Announcements;
use App\Entity\User;
use App\Form\AnnouncementsType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function admin(Request $request, UserAuthenticatorInterface $userAuthenticator, EntityManagerInterface $entityManager): Response
    {
        $annoucements = new Announcements();
        $form = $this->createForm(AnnouncementsType::class, $annoucements);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annoucements->setDate(new \DateTime);
            // encode the plain password
            $entityManager->persist($annoucements);
            $entityManager->flush();
            $this->addFlash('success', 'youre logged in' );


            return $this->redirectToRoute('app_home');
        }
        return $this->render('admin/index.html.twig', [
            "form" => $form->createView(),
        ]);
    }
}
