<?php

namespace App\Controller;

use App\Entity\Announcements;
use App\Entity\Bijles;
use App\Form\BijlesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocentController extends AbstractController
{
    #[Route('/docent', name: 'app_docent')]
    public function index(): Response
    {
        if ($this->getUser()){
            $this->addFlash('success', 'youre logged in as docent'. ' ');
        }
        return $this->render('docent/index.html.twig', [
            'controller_name' => 'DocentController',
        ]);
    }
    #[Route('/docent/bijles', name: 'app_bijles')]
    public function bijles(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bijles = new Bijles();
        $form = $this->createForm(BijlesType::class, $bijles);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($bijles);
            $entityManager->flush();
            return $this->redirectToRoute('app_docent');
        }
        return $this->render('docent/bijles.html.twig', [
            'bijlesForm' => $form->createView(),
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
