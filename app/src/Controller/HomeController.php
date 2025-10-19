<?php

namespace App\Controller;

use App\Entity\Route as AppRoute;
use App\Repository\RouteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(RouteRepository $routeRepository): Response
    {
        // récupère tous les trajets
        // $routes = $routeRepository->findAll();
        $routes = $routeRepository->findLatest(5);

        return $this->render('index.html.twig', [
            'routes' => $routes,
            
        ]);
}
    // 
    // #[Route('/covoiturage', name: 'app_covoiturage')]
    // public function covoiturage(EntityManagerInterface $em): Response
    // {
    //     // Récupérer tous les trajets
    //     $routes = $em->getRepository(AppRoute::class)->findAll();

    //     return $this->render('covoiturage/index.html.twig', [
    //         'routes' => $routes,
    //     ]);
    // }


}
