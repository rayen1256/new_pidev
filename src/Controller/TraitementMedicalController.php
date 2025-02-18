<?php

namespace App\Controller;

use App\Entity\TraitementMedical;
use App\Form\TraitementMedicalType;
use App\Repository\TraitementMedicalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/traitement/medical')]
final class TraitementMedicalController extends AbstractController
{
    #[Route(name: 'app_traitement_medical_index', methods: ['GET'])]
    public function index(TraitementMedicalRepository $traitementMedicalRepository): Response
    {
        return $this->render('traitement_medical/index.html.twig', [
            'traitement_medicals' => $traitementMedicalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_traitement_medical_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $traitementMedical = new TraitementMedical();
        $form = $this->createForm(TraitementMedicalType::class, $traitementMedical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($traitementMedical);
            $entityManager->flush();

            return $this->redirectToRoute('app_traitement_medical_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('traitement_medical/new.html.twig', [
            'traitement_medical' => $traitementMedical,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_traitement_medical_show', methods: ['GET'])]
    public function show(TraitementMedical $traitementMedical): Response
    {
        return $this->render('traitement_medical/show.html.twig', [
            'traitement_medical' => $traitementMedical,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_traitement_medical_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TraitementMedical $traitementMedical, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TraitementMedicalType::class, $traitementMedical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_traitement_medical_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('traitement_medical/edit.html.twig', [
            'traitement_medical' => $traitementMedical,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_traitement_medical_delete', methods: ['POST'])]
    public function delete(Request $request, TraitementMedical $traitementMedical, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$traitementMedical->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($traitementMedical);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_traitement_medical_index', [], Response::HTTP_SEE_OTHER);
    }
}
