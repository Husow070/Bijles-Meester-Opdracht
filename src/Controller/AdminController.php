<?php

namespace App\Controller;

use App\Entity\Announcements;
use App\Entity\User;
use App\Form\AnnouncementsType;
use App\Form\RegistrationFormType;
use App\Security\LoginFormAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class AdminController extends AbstractController
{
    #[Route('/admin/announcements', name: 'app_announcements')]
    public function admin(Request $request, UserAuthenticatorInterface $userAuthenticator, EntityManagerInterface $entityManager, ): Response
    {
        $annoucements = new Announcements();
        $form = $this->createForm(AnnouncementsType::class, $annoucements);
        $form->handleRequest($request);
        $announcements= $entityManager->getRepository(Announcements::class)->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $annoucements->setDate(new \DateTime);
            // encode the plain password
            $entityManager->persist($annoucements);
            $entityManager->flush();


            return $this->redirectToRoute('app_admin');
        }
        return $this->renderForm('admin/announcements.html.twig', [
            "form" => $form,
            'announcements' => $announcements
        ]);
    }
    #[Route('/adminregister', name: 'app_admin_register')]
    public function adminregister(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, LoginFormAuthenticator $authenticator, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        $user->setRoles((array)'ROLE_DOCENT');
        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password

            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->render('admin/index.html.twig');
            // do anything else you need here, like send an email
        }

        return $this->render('admin/adminregister.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/admin', name: 'app_admin')]
    public function announcements(): Response
    {
        $this->addFlash('success', 'youre logged in as admin'. ' ' );
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'announcementsController',
        ]);
    }



}
