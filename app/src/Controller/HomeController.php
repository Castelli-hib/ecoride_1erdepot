<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/covoiturage', name: 'app_covoiturage')]
    public function covoiturage(): Response
    {
        return $this->render('covoiturage.html.twig', [
            'controller_name' => 'Covoiturage',
        ]);
    }


}
