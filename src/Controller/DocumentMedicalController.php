<?php

namespace App\Controller;

use App\Entity\DocumentMedical;
use App\Form\DocumentMedicalType;
use App\Repository\DocumentMedicalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/document/medical')]
final class DocumentMedicalController extends AbstractController
{
    #[Route(name: 'app_document_medical_index', methods: ['GET'])]
    public function index(DocumentMedicalRepository $documentMedicalRepository): Response
    {
        return $this->render('document_medical/index.html.twig', [
            'document_medicals' => $documentMedicalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_document_medical_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $documentMedical = new DocumentMedical();
        $form = $this->createForm(DocumentMedicalType::class, $documentMedical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file upload
            $file = $form->get('fichier')->getData();  // Assuming the form field name is 'fichier'

            if ($file) {
                $newFilename = uniqid() . '.' . $file->guessExtension(); // Generate unique filename

                try {
                    $file->move(
                        $this->getParameter('documents_directory'), // Directory path from services.yaml
                        $newFilename
                    );
                    $documentMedical->setFichier($newFilename); // Save filename to entity
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload du fichier.');
                }
            }

            $entityManager->persist($documentMedical);
            $entityManager->flush();

            return $this->redirectToRoute('app_document_medical_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('document_medical/new.html.twig', [
            'document_medical' => $documentMedical,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_document_medical_show', methods: ['GET'])]
    public function show(DocumentMedical $documentMedical): Response
    {
        return $this->render('document_medical/show.html.twig', [
            'document_medical' => $documentMedical,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_document_medical_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DocumentMedical $documentMedical, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DocumentMedicalType::class, $documentMedical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Handle file upload in case of update
            $file = $form->get('fichier')->getData();

            if ($file) {
                $newFilename = uniqid() . '.' . $file->guessExtension();  // Generate unique filename

                try {
                    $file->move(
                        $this->getParameter('documents_directory'),
                        $newFilename
                    );
                    $documentMedical->setFichier($newFilename);  // Save new filename
                } catch (FileException $e) {
                    $this->addFlash('error', 'Erreur lors de l\'upload du fichier.');
                }
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_document_medical_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('document_medical/edit.html.twig', [
            'document_medical' => $documentMedical,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_document_medical_delete', methods: ['POST'])]
    public function delete(Request $request, DocumentMedical $documentMedical, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$documentMedical->getId(), $request->get('_token'))) {
            $entityManager->remove($documentMedical);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_document_medical_index', [], Response::HTTP_SEE_OTHER);
    }
}
