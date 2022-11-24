<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    #[Route('/list-client-produit', name: 'list_client_produit')]
    public function index(): Response
    {
        //njib l produit 
        return $this->render('recherche/list_clients.html.twig', [
            'controller_name' => 'RechercheController',
        ]);
    }
}
