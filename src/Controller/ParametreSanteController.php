<?php

namespace App\Controller;

use App\Entity\ParametreSante;
use App\Form\ParametreSanteType;
use App\Repository\ParametreSanteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/parametre/sante')]
final class ParametreSanteController extends AbstractController
{
    #[Route(name: 'app_parametre_sante_index', methods: ['GET'])]
    public function index(ParametreSanteRepository $parametreSanteRepository): Response
    {
        return $this->render('parametre_sante/index.html.twig', [
            'parametre_santes' => $parametreSanteRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_parametre_sante_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $parametreSante = new ParametreSante();
        $form = $this->createForm(ParametreSanteType::class, $parametreSante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($parametreSante);
            $entityManager->flush();

            return $this->redirectToRoute('app_parametre_sante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parametre_sante/new.html.twig', [
            'parametre_sante' => $parametreSante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parametre_sante_show', methods: ['GET'])]
    public function show(ParametreSante $parametreSante): Response
    {
        return $this->render('parametre_sante/show.html.twig', [
            'parametre_sante' => $parametreSante,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_parametre_sante_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ParametreSante $parametreSante, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ParametreSanteType::class, $parametreSante);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_parametre_sante_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('parametre_sante/edit.html.twig', [
            'parametre_sante' => $parametreSante,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_parametre_sante_delete', methods: ['POST'])]
    public function delete(Request $request, ParametreSante $parametreSante, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parametreSante->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($parametreSante);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_parametre_sante_index', [], Response::HTTP_SEE_OTHER);
    }
}
