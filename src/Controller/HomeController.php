<?php

namespace App\Controller;

use App\Entity\Announcements;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/user/announcements', name: 'app_announcementleerling')]
    public function announcementsleerling(EntityManagerInterface $entityManager): Response
    {
        $announcements= $entityManager->getRepository(Announcements::class)->findAll();
        return $this->render('user/announcementleerling.html.twig', [
            'controller_name' => 'HomeController',
            'announcements' => $announcements
        ]);
    }
    /**
     * @Route("/redirect", name="redirect")
     */
    public function redirectAction(Security $security)
    {
        if ($security->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin');
        }
        if ($security->isGranted('ROLE_DOCENT')) {
            return $this->redirectToRoute('app_docent');
        }
        if ($security->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_user');
        }
        return $this->redirectToRoute('app_home');
    }
}
