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

    #[Route('/rou', name: 'app_rendez_vous_indext', methods: ['GET'])]
public function indext(RendezVousRepository $rendezVousRepository): Response
{
    // Récupérer l'utilisateur connecté (médecin)
    $user = $this->getUser();

    // Filtrer les rendez-vous pour ce médecin
    $rendezVousList = $rendezVousRepository->findBy(['relation' => $user]);
    $rendezVousList = $rendezVousRepository->findBy(['RelationMedecin' => $user]);

    return $this->render('rendez_vous/ListRendezVousCoteMedecin.html.twig', [
        'rendez_vouses' => $rendezVousList,
    ]);
}

#[Route('/confirmer/{id}', name: 'app_rendez_vous_confirmer', methods: ['POST'])]
public function confirmer(Request $request, RendezVous $rendezVou, EntityManagerInterface $entityManager): Response
{
    if ($this->isCsrfTokenValid('confirmer'.$rendezVou->getId(), $request->request->get('_token'))) {
        $rendezVou->setStatut('confirmé');
        $entityManager->flush();
    }

    return $this->redirectToRoute('app_rendez_vous_indext');
}

#[Route('/annuler/{id}', name: 'app_rendez_vous_annuler', methods: ['POST'])]
public function annuler(Request $request, RendezVous $rendezVou, EntityManagerInterface $entityManager): Response
{
    if ($this->isCsrfTokenValid('annuler'.$rendezVou->getId(), $request->request->get('_token'))) {
        $rendezVou->setStatut('annulé');
        $entityManager->flush();
    }

    return $this->redirectToRoute('app_rendez_vous_indext');
}


#[Route('/saw', name: 'app_rendez_vous_indexx', methods: ['GET'])]
public function indexx(RendezVousRepository $rendezVousRepository): Response
{
    $user = $this->getUser(); // Récupère l'utilisateur connecté

    // Utilise la méthode findByUser avec l'objet utilisateur
    $rendezVousList = $rendezVousRepository->findByUser($user);

    return $this->render('rendez_vous/ListRendezVous.html.twig', [
        'rendez_vous' => $rendezVousList,
    ]);
}



    #[Route('/new/{medecin_id}', name: 'app_rendez_vous_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository, int $medecin_id = null): Response
{
    $rendezVou = new RendezVous();
    $form = $this->createForm(RendezVousType::class, $rendezVou);

    // Si un ID de médecin est fourni, pré-remplir le champ NomMedecin
    if ($medecin_id !== null) {
        $medecin = $userRepository->find($medecin_id);
        if ($medecin) {
            $rendezVou->setNomMedecin($medecin->getUsername());
        }
    }

    $form->handleRequest($request);
    $rendezVou->setStatut('en attente');

    if ($form->isSubmitted() && $form->isValid()) {
        $rendezVou->setRelation($this->getUser());
        $rendezVou->setRelationMedecin($this->getUser());
        
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
