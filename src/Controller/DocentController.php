<?php

namespace App\Controller;

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
}
