<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Ram;
use App\Form\RamFormType;
use App\Repository\RamRepository;

class RamController extends AbstractController
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //afficher
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('/ram', name: 'ram.show')]
    public function index(RamRepository $ramrepo): Response
    {   
        $showram = $ramrepo->findBy([],['id' => 'DESC']);
        return $this->render('Ram/index.html.twig', [
            'showram'=>$showram

        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Ajouter
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('ram/ajouter', name: 'ram.add')]
    public function CreerRam(Request $request,  EntityManagerInterface $manager): Response
    {
        $ram = new Ram();
        $form_ram = $this->createForm(RamFormType::class, $ram);
        $form_ram -> handleRequest($request);

        if( $form_ram->isSubmitted() && $form_ram->isValid()){
            $manager->persist($ram);
            $manager->flush();

            return $this->redirectToRoute('ram.show',['id'=>$ram->getId()]);
        }


        return $this->render('Ram/ajouterram.html.twig', [
            'form_ram'=> $form_ram->createView()
        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Modifier
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('ram/{id}', name: 'ram.edit')]
    public function ModifierRam(RamRepository $ramrepo, Request $request, EntityManagerInterface $manager, $id): Response
    {
        $ram = $ramrepo->find($id);

        if (!$ram) {
            throw $this->createNotFoundException('Données introuvables pour l\'ID '.$id);
        }

        $formram = $this->createForm(RamFormType::class, $ram);
        $formram->handleRequest($request);

        if ($formram->isSubmitted() && $formram->isValid()) {
            $manager->flush();

            // Rediriger vers une page de confirmation ou une autre action
            return $this->redirectToRoute('ram.show');
        }

        return $this->render('Ram/modifierram.html.twig', [
            ['id' => $id],
            'formram' => $formram->createView(),
        ]);
    }

    
}
