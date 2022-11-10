<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Commentaire;
use App\Entity\Images;
use App\Entity\Reservation;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('StephanieDeVregille');
    }

    public function configureMenuItems(): iterable
    {
        return[
            MenuItem::linkToRoute("Retour à l'accueil", 'fas fa-arrow-left', 'app_main'),
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Gestion des données'),
            MenuItem::linkToCrud('Articles', 'fas fa-newspaper', Article::class),
            MenuItem::linkToCrud('commentaires', 'fas fa-pen', Commentaire::class),
            MenuItem::linkToCrud('images', 'fas fa-camera', Images::class),
            MenuItem::section('Utilisateurs'),
            MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class),
            MenuItem::section('Reservations'),
            MenuItem::linkToCrud('reservations', 'fas fa-calendar', Reservation::class),
        ];
    }
}
