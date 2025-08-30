<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('pages/admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin_connection', name: 'app_admin_connection')]
    public function connection(): Response
    {
        return $this->render('pages/admin/connection.html.twig', [
            'controller_name' => 'AdminConnection',
        ]);
    }

    #[Route('/admin_dashboard', name: 'app_admin_dashboard')]
    public function adminDashboard(): Response
    {
        return $this->render('pages/admin/admin_dashboard.html.twig', [
            'controller_name' => 'AdminDashboard',
        ]);
    }
    #[Route('/admin_users', name: 'app_admin_users')]
    public function adminUsers(): Response  
    {
        return $this->render('pages/admin/admin_users.html.twig', [
            'controller_name' => 'AdminUsers',
        ]);
    }
    #[Route('/admin_routes', name: 'app_admin_routes')]
    public function adminRoutes(): Response
    {
        return $this->render('pages/admin/admin_routes.html.twig', [
            'controller_name' => 'AdminRoutes',
        ]);
    }
    #[Route('/admin_reservations', name: 'app_admin_reservations')]
    public function adminReservations(): Response
    {
        return $this->render('pages/admin/admin_reservations.html.twig', [
            'controller_name' => 'AdminReservations',
        ]);
    }
}
