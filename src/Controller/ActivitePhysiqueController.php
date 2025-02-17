<?php

namespace App\Controller;

use App\Entity\ActivitePhysique;
use App\Form\ActivitePhysiqueType;
use App\Repository\ActivitePhysiqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/activite/physique')]
final class ActivitePhysiqueController extends AbstractController
{
    #[Route(name: 'app_activite_physique_index', methods: ['GET'])]
    public function index(ActivitePhysiqueRepository $activitePhysiqueRepository): Response
    {
        $activites = $activitePhysiqueRepository->findAll();

        // Calculer la durée moyenne des activités
        $totalDuree = array_reduce($activites, fn($sum, $a) => $sum + $a->getDuree(), 0);
        $dureeMoyenne = count($activites) > 0 ? $totalDuree / count($activites) : 0;

        return $this->render('activite_physique/activites_liste.html.twig', [
            'activite_physiques' => $activites,
            'duree_moyenne' => $dureeMoyenne, // Envoyer au template
        ]);
    }

    #[Route('/new', name: 'app_activite_physique_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $activitePhysique = new ActivitePhysique();
        $form = $this->createForm(ActivitePhysiqueType::class, $activitePhysique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($activitePhysique->getDescription() === null) {
                $activitePhysique->setDescription('Valeur par défaut');
            }

            $entityManager->persist($activitePhysique);
            $entityManager->flush();

            return $this->redirectToRoute('app_activite_physique_index');
        }

        return $this->render('activite_physique/activite_physique_form.html.twig', [
            'form' => $form->createView(),
            'activite_physique' => $activitePhysique, // Ajouter cette ligne
        ]);
    }

    #[Route('/{id}', name: 'app_activite_physique_show', methods: ['GET'])]
    public function show(ActivitePhysique $activitePhysique): Response
    {
        return $this->render('activite_physique/activite_show.html.twig', [
            'activite_physique' => $activitePhysique,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_activite_physique_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ActivitePhysique $activitePhysique, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ActivitePhysiqueType::class, $activitePhysique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($activitePhysique->getDescription() === null) {
                $activitePhysique->setDescription('Valeur par défaut');
            }

            $entityManager->flush();

            return $this->redirectToRoute('app_activite_physique_index');
        }

        return $this->render('activite_physique/activite_modifie.html.twig', [
            'form' => $form->createView(),
            'activite_physique' => $activitePhysique, // Ajouter cette ligne
        ]);
    }

    #[Route('/{id}', name: 'app_activite_physique_delete', methods: ['POST'])]
    public function delete(Request $request, ActivitePhysique $activitePhysique, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$activitePhysique->getId(), $request->request->get('_token'))) {
            $entityManager->remove($activitePhysique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_activite_physique_index');
    }
}
