<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Boitier;
use App\Form\BoitierFormType;
use App\Repository\BoitierRepository;


class BoitierController extends AbstractController
{

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //afficher
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('/boitier', name: 'boitier.show')]
    public function index(BoitierRepository $boitierrepo): Response
    {
        $showboitier = $boitierrepo->findBy([],['id' => 'DESC']);
        return $this->render('boitier/index.html.twig', [
            'showboitier'=>$showboitier
        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Ajouter
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('boitier/ajouter', name: 'boitier.add')]
    public function AjouterBoitier(Request $request,  EntityManagerInterface $manager): Response
    {   $boitier = new Boitier();
        $form_boitier = $this->createForm(BoitierFormType::class,$boitier);
        $form_boitier -> handleRequest($request);
    
        if( $form_boitier->isSubmitted() && $form_boitier->isValid()){
            
            $manager->persist($boitier);
            $manager->flush();

            return $this->redirectToRoute('boitier.show',[
            ]);
        }

        return $this->render('boitier/ajouterboitier.html.twig', [
            'form_boitier' => $form_boitier->createView()
        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Supprimer
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    #[Route('boitier/{id}', name: 'boitier.delete', methods: ['DELETE'])]
    public function delete(Boitier $boitier, EntityManagerInterface $entityManager, Request $request): Response
    {
        if($this->isCsrfTokenValid('delete'.$boitier->getId(), $request->get('_token')))
        {
            $entityManager->remove($boitier);
            $entityManager->flush();

            //$this->addFlash('success', "Le serveur a bien été supprimé !");
        }

        return $this->redirectToRoute('boitier.show');
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Modifier
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    #[Route('boitier/{id}', name: 'boitier.edit', methods: ['GET', 'POST'])]
    public function ModifierBoitier(Boitier $boitier, Request $request, EntityManagerInterface $manager ): Response
    {
        $formboitier = $this->createForm(BoitierFormType::class, $boitier);
        $formboitier->handleRequest($request);

        if ($formboitier->isSubmitted() && $formboitier->isValid()) {
            $manager->persist($boitier);
            $manager->flush();

            // Rediriger vers une page de confirmation ou une autre action
            return $this->redirectToRoute('boitier.show');
        }

        return $this->render('boitier/modifierboitier.html.twig', [
           'formboitier' => $formboitier->createView(),
        ]);
    }
}
