<?php

namespace App\Controller;

use App\Entity\Habitudes;
use App\Form\HabitudesType;
use App\Repository\HabitudesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/habitudes')]
final class HabitudesController extends AbstractController
{
    #[Route(name: 'app_habitudes_index', methods: ['GET'])]
    public function index(HabitudesRepository $habitudesRepository): Response
    {
        return $this->render('habitudes/habitudes_liste.html.twig', [
            'habitudes' => $habitudesRepository->findAll(),
        ]);
    }

    #[Route('/neww', name: 'app_habitudes_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $habitude = new Habitudes();
        $form = $this->createForm(HabitudesType::class, $habitude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($habitude);
            $entityManager->flush();

            return $this->redirectToRoute('app_habitudes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('habitudes/habitude_form.html.twig', [
            'habitude' => $habitude,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_habitudes_show', methods: ['GET'])]
    public function show(Habitudes $habitude): Response
    {
        return $this->render('habitudes/show.html.twig', [
            'habitude' => $habitude,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_habitudes_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Habitudes $habitude, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HabitudesType::class, $habitude);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_habitudes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('habitudes/edit.html.twig', [
            'habitude' => $habitude,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_habitudes_delete', methods: ['POST'])]
    public function delete(Request $request, Habitudes $habitude, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$habitude->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($habitude);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_habitudes_index', [], Response::HTTP_SEE_OTHER);
    }
}
