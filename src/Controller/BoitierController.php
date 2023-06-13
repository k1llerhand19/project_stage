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
    #[Route('/boitier', name: 'boitier.show')]
    public function index(BoitierRepository $boitierrepo): Response
    {
        $showboitier = $boitierrepo->findBy([],['id' => 'DESC']);
        return $this->render('boitier/index.html.twig', [
            'controller_name' => 'BoitierController',
            'showboitier'=>$showboitier
        ]);
    }

    #[Route('boitier/ajouter', name: 'boitier.add')]
    public function AjouterBoitier(Request $request,  EntityManagerInterface $manager): Response
    {   $boitier = new Boitier();
        $form_boitier = $this->createForm(BoitierFormType::class,$boitier);
        $form_boitier -> handleRequest($request);
    
        if( $form_boitier->isSubmitted() && $form_boitier->isValid()){
            
            $manager->persist($boitier);
            $manager->flush();

            return $this->redirectToRoute('boitier.show',['id'=> $boitier->getId()
            ]);
        }

        return $this->render('boitier/ajouterboitier.html.twig', [
            'controller_name' => 'BoitierController',
            'form_boitier' => $form_boitier->createView()
        ]);
    }

    #[Route('boitier/{id}', name: 'boitier.edit')]
    public function ModifierBoitier(): Response
    {
        return $this->render('boitier/modifierboitier.html.twig', [
            'controller_name' => 'AlimController',
        ]);
    }
}
