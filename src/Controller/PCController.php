<?php

namespace App\Controller;

use App\Entity\PC;
use App\Form\PCType;
use App\Repository\PCRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/p/c')]
class PCController extends AbstractController
{
    #[Route('/', name: 'app_p_c_index', methods: ['GET'])]
    public function index(PCRepository $pCRepository): Response
    {
        return $this->render('pc/index.html.twig', [
            'p_cs' => $pCRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_p_c_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PCRepository $pCRepository): Response
    {
        $pC = new PC();
        $form = $this->createForm(PCType::class, $pC);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pCRepository->save($pC, true);

            return $this->redirectToRoute('app_p_c_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pc/new.html.twig', [
            'p_c' => $pC,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_p_c_show', methods: ['GET'])]
    public function show(PC $pC): Response
    {
        return $this->render('pc/show.html.twig', [
            'p_c' => $pC,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_p_c_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PC $pC, PCRepository $pCRepository): Response
    {
        $form = $this->createForm(PCType::class, $pC);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pCRepository->save($pC, true);

            return $this->redirectToRoute('app_p_c_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pc/edit.html.twig', [
            'p_c' => $pC,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_p_c_delete', methods: ['POST'])]
    public function delete(Request $request, PC $pC, PCRepository $pCRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pC->getId(), $request->request->get('_token'))) {
            $pCRepository->remove($pC, true);
        }

        return $this->redirectToRoute('app_p_c_index', [], Response::HTTP_SEE_OTHER);
    }
}
