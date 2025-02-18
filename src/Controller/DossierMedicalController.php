<?php

namespace App\Controller;

use App\Entity\DossierMedical;
use App\Form\DossierMedicalType;
use App\Repository\DossierMedicalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/dossier/medica/l')]
final class DossierMedicalController extends AbstractController
{
    #[Route(name: 'app_dossier_medica_l_index', methods: ['GET'])]
    public function index(DossierMedicalRepository $dossierMedicalRepository): Response
    {
        return $this->render('dossier_medica_l/index.html.twig', [
            'dossier_medica_ls' => $dossierMedicalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_dossier_medica_l_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dossierMedical = new DossierMedical();
        $form = $this->createForm(DossierMedicalType::class, $dossierMedical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dossierMedical);
            $entityManager->flush();

            return $this->redirectToRoute('app_dossier_medica_l_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dossier_medica_l/new.html.twig', [
            'dossier_medica_l' => $dossierMedical,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/show', name: 'app_dossier_medica_l_show', methods: ['GET'])]
    public function show(DossierMedical $dossierMedical): Response
    {
        return $this->render('dossier_medica_l/show.html.twig', [
            'dossier_medica_l' => $dossierMedical,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_dossier_medica_l_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DossierMedical $dossierMedical, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DossierMedicalType::class, $dossierMedical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_dossier_medica_l_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('dossier_medica_l/edit.html.twig', [
            'dossier_medica_l' => $dossierMedical,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_dossier_medica_l_delete', methods: ['POST'])]
    public function delete(Request $request, DossierMedical $dossierMedical, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dossierMedical->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($dossierMedical);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_dossier_medica_l_index', [], Response::HTTP_SEE_OTHER);
    }
}
