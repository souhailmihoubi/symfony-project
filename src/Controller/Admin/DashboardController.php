<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Facture;
use App\Entity\PC;
use App\Entity\Produit;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Menu\DashboardMenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Mini Projet0')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Produit','fa-brands fa-product-hunt',Produit::class);
        yield MenuItem::linkToCrud('Client', 'fa-solid fa-user', Client::class);
        yield MenuItem::linkToCrud('Commande', 'fa fa-shopping-bag', Commande::class);
        yield MenuItem::linkToCrud('Produit/Commande', 'fa fa-shopping-bag', PC::class);
        yield MenuItem::linkToCrud('Facture', 'fa fa-money', Facture::class);
        yield MenuItem::linkToRoute('Question 1' , 'fas fa-regular fa-pen' , 'question1');
        


    }
}
