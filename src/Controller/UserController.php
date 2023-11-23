<?php

namespace App\Controller;

use App\Entity\Announcements;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_home_user')]
    public function user(): Response
    {
        if ($this->getUser()){
            $this->addFlash('success', 'youre logged in' );
        }
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    #[Route('/user/announcements', name: 'app_announcementleerling')]
    public function announcementsleerling(EntityManagerInterface $entityManager): Response
    {
        $announcements= $entityManager->getRepository(Announcements::class)->findBy(['rol' => 'Leerling']);
        return $this->render('user/announcementleerling.html.twig', [
            'controller_name' => 'HomeController',
            'announcements' => $announcements
        ]);
    }
}
