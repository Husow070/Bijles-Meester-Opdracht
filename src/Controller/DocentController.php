<?php

namespace App\Controller;

use App\Entity\Announcements;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocentController extends AbstractController
{
    #[Route('/docent', name: 'app_docent')]
    public function index(): Response
    {
        if ($this->getUser()){
            $this->addFlash('success', 'youre logged in' );
        }
        return $this->render('docent/index.html.twig', [
            'controller_name' => 'DocentController',
        ]);
    }
    #[Route('/docent/announcementdocent', name: 'app_announcementdocent')]
    public function announcementsdocent(EntityManagerInterface $entityManager): Response
    {
        $announcements= $entityManager->getRepository(Announcements::class)->findBy(['rol' => 'Docent']);
        return $this->render('docent/announcementdocent.html.twig', [
            'controller_name' => 'HomeController',
            'announcements' => $announcements
        ]);
    }
}
