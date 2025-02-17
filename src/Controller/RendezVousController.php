<?php

namespace App\Controller;

use App\Entity\RendezVous;
use App\Form\RendezVousType;
use App\Repository\RendezVousRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/rendez/vous')]
final class RendezVousController extends AbstractController
{
    //#[Route(name: 'app_rendez_vous_index', methods: ['GET'])]
    //public function index(RendezVousRepository $rendezVousRepository): Response
    //{
       // return $this->render('rendez_vous/ListeMedecin.html.twig', [
         //   'rendez_vouses' => $rendezVousRepository->findAll(),
        //]);
    //}



    #[Route('/medecins', name: 'app_rendez_vous_index', methods: ['GET'])]
    public function listeMedecins(UserRepository $userRepository): Response
    {
        // Récupère les médecins (utilisateurs avec le rôle ROLE_MEDECIN)
        $medecins = $userRepository->findByRole('ROLE_MEDECIN');

        // Affiche la liste des médecins
        return $this->render('rendez_vous/ListeMedecin.html.twig', [
            'medecins' => $medecins,
        ]);
    }

    #[Route('/rou' ,name: 'app_rendez_vous_indext', methods: ['GET'])]
    public function indext(RendezVousRepository $rendezVousRepository): Response
    {
        return $this->render('rendez_vous/ListRendezVousCoteMedecin.html.twig', [
            'rendez_vouses' => $rendezVousRepository->findAll(),
        ]);
    }


    #[Route('/saw' ,name: 'app_rendez_vous_indexx', methods: ['GET'])]
    public function indexx(RendezVousRepository $rendezVousRepository): Response
    {
        return $this->render('rendez_vous/ListRendezVous.html.twig', [
            'rendez_vous' => $rendezVousRepository->findAll(),
        ]);
    }



    #[Route('/new', name: 'app_rendez_vous_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rendezVou = new RendezVous();
        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);
        $rendezVou->setStatut('en attente');

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rendezVou);
            $entityManager->flush();

            return $this->redirectToRoute('app_rendez_vous_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rendez_vous/Reservez-vous.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form,
        ]);
    }

    //#[Route('/{id}', name: 'app_rendez_vous_show', methods: ['GET'])]
    //public function show(RendezVous $rendezVou): Response
    //{
      //  return $this->render('rendez_vous/show.html.twig', [
        //    'rendez_vou' => $rendezVou,
        //]);
    //}

    #[Route('/{id}/edit', name: 'app_rendez_vous_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RendezVous $rendezVou,RendezVousRepository $repo , $id , EntityManagerInterface $entityManager, ManagerRegistry $manager): Response
    {
        $em = $manager->getManager();
        $rendezVou = $repo->find($id);
        if (!$rendezVou){
            throw $this->createNotFoundException('not found rendez vous');
        }

        $form = $this->createForm(RendezVousType::class, $rendezVou);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_rendez_vous_indexx', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rendez_vous/FormulaireEdit.html.twig', [
            'rendez_vou' => $rendezVou,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rendez_vous_delete', methods: ['POST'])]
    public function delete(Request $request, RendezVous $rendezVou, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rendezVou->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($rendezVou);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_rendez_vous_indexx', [], Response::HTTP_SEE_OTHER);
    }
}
