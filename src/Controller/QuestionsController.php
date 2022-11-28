<?php

namespace App\Controller;

use DateTime;
use App\Entity\Client;
use App\Entity\Produit;
use App\Form\VilleType;
use App\Form\ClientType;
use App\Form\ProduitType;

use App\Entity\ClientSearch;
use App\Entity\ProductSearch;
use App\Form\ClientSearchType;
use App\Form\ProductSearchType;
use App\Repository\ClientRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class QuestionsController extends AbstractController
{
    /*   #[Route('/question1', name: 'question1')]
    public function q1(): Response
    {
        return $this->render('questions/q1.html.twig', [
            'controller_name' => 'QuestionsController',
        ]);
    }*/

    #[Route('/question1', name: 'question1')]
    public function ClientProduit(Request $request, ClientRepository $repository)
    {
        $productSearch = new ProductSearch();
        $form = $this->createForm(ProductSearchType::class, $productSearch);
        $form->handleRequest($request);
        $clients = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $produit = $productSearch->getProduit();

            if ($produit != "") {
                $clients = $repository->getClientsByProduct($produit->getLib());
            } else
                $clients = $repository->findAll();
        }
        return $this->render(
            'questions/q1.html.twig',
            ['form' => $form->createView(), 'clients' => $clients]
        );
    }
    #[Route('/question5', name: 'question5')]
    public function ClientCommande(Request $request, ClientRepository $repository)
    {
        $clientSearch = new ClientSearch();
        $form = $this->createForm(ClientSearchType::class, $clientSearch);
        $form->handleRequest($request);
        $commands = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $client = $clientSearch->getClient();

            if ($client != "") {
                $commands = $repository->getProductByClient($client->getId());
            } else
                $commands = $repository->findAll();
        }
        return $this->render(
            'questions/q5.html.twig',
            ['form' => $form->createView(), 'commands' => $commands]
        );
    }


    #[Route('/question2', name: 'question2')]
    public function q2(Request $request, ClientRepository $repository): Response
    {
        $form = $this->createFormBuilder()
            ->add('ville', TextType::class)
            ->getForm();

        $form->handleRequest($request);

        $clients = 0;

        if ($form->isSubmitted() && $form->isValid()) {

            $d = $form->getData();
            $data = $d['ville'];

            if ($data != "") {

                $c = $repository->getClientByVille($data);
                $clients = $c[0]['COUNT(*)'];
            } else
                $clients = $repository->findAll();
        }

        return $this->render('questions/q2.html.twig', ['form' => $form->createView(), 'clients' => $clients]);
    }




    #[Route('/question3', name: 'question3')]
    public function q3(Request $request, ClientRepository $repository): Response
    {
        $form = $this->createFormBuilder()
            ->add(
                'Date1',
                DateTimeType::class,
                [
                    'widget' => 'single_text',
                    'attr' => [
                        'style' => 'width:400px',
                        'class' => "form-control mb-3 col-xs-",
                        'date_format' => 'yyyy-MM-dd',
                    ],
                ]
            )
            ->add(
                'Date2',
                DateTimeType::class,
                [
                    'widget' => 'single_text',
                    'attr' => [
                        'style' => 'width:400px',
                        'class' => "form-control mb-3 col-xs-",
                        'date_format' => 'yyyy-MM-dd',
                    ],
                ]
            )
            ->getForm()
        ;
        $form->handleRequest($request);

        $clients =0;
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();
            $date1 = $data["Date1"];
            $d1 = $date1->format('Y/m/d');
            $date2 = $data["Date2"];
            $d2 = $date2->format('Y/m/d');

            if ($d1 != "" && $d2 != "") {

                $clients = $repository->getClientByDate($d1,$d2);
            } else
                $clients = $repository->findAll();
        }

        return $this->render('questions/q3.html.twig', ['form' => $form->createView(),'clients' => $clients]);
    }

    #[Route('/question4', name: 'question4')]
    public function q4(ClientRepository $repository): Response
    {
        $produits=$repository->getMinQuantity();

        return $this->render('questions/q4.html.twig',['produits' => $produits]);
    }
}
