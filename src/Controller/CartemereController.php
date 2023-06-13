<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Cartemere;
use App\Form\CartemereFormType;
use App\Repository\CartemereRepository;


class CartemereController extends AbstractController
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //afficher
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('/cartemere', name: 'cartemere.show')]
    public function index(CartemereRepository $cmrepo): Response
    {        $showcm = $cmrepo->findBy([],['id' => 'DESC']);
        

        return $this->render('cartemere/index.html.twig', [
            'showcm'=>$showcm

        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Ajouter
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('cartemere/ajouter', name: 'cartemere.add')]
    public function AjouterBoitier(Request $request,  EntityManagerInterface $manager): Response
    {   $cm = new Cartemere();
        $form_Cm = $this->createForm(CartemereFormType::class,$cm);
        $form_Cm -> handleRequest($request);
    
        if( $form_Cm->isSubmitted() && $form_Cm->isValid()){
            
            $manager->persist($cm);
            $manager->flush();

            return $this->redirectToRoute('cartemere.show',['id'=> $cm->getId()
            ]);
        }

        return $this->render('cartemere/Ajoutercm.html.twig', [
            'form_Cm' => $form_Cm->createView()
        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Modifier
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('cartemere/{id}', name: 'cartemere.edit')]
    public function ModifierBoitier(CartemereRepository $cmrepo, Request $request, EntityManagerInterface $manager, $id): Response
    {
        $cm = $cmrepo->find($id);

        if (!$cm) {
            throw $this->createNotFoundException('Données introuvables pour l\'ID '.$id);
        }

        $formcm = $this->createForm(CartemereFormType::class, $cm);
        $formcm->handleRequest($request);

        if ($formcm->isSubmitted() && $formcm->isValid()) {
            $manager->flush();

            // Rediriger vers une page de confirmation ou une autre action
            return $this->redirectToRoute('cartemere.show');
        }

        return $this->render('cartemere/Modifiercm.html.twig', [
            ['id' => $id],
            'formcm' => $formcm->createView(),
        ]);
    }
}
