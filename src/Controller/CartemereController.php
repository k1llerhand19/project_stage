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
    #[Route('/cartemere', name: 'cartemere.show')]
    public function index(CartemereRepository $cmrepo): Response
    {        $showcm = $cmrepo->findBy([],['id' => 'DESC']);
        

        return $this->render('cartemere/index.html.twig', [
            'controller_name' => 'CartemereController',
            'showcm'=>$showcm

        ]);
    }


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
            'controller_name' => 'CartemereController',
            'form_Cm' => $form_Cm->createView()
        ]);
    }




    #[Route('cartemere/{id}', name: 'cartemere.edit')]
    public function ModifierBoitier(): Response
    {
        return $this->render('cartemere/Modifiercm.html.twig', [
            'controller_name' => 'CartemereController',
        ]);
    }
}
