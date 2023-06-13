<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Hdd;
use App\Form\HddFormType;
use App\Repository\HddRepository;


class HddController extends AbstractController
{
    #[Route('/hdd', name: 'hdd.show')]
    public function index(HddRepository $hddrepo): Response
    {   
        $showhdd = $hddrepo->findBy([],['id' => 'DESC']);

        return $this->render('hdd/index.html.twig', [
            'controller_name' => 'HddController',
            'showhdd'=>$showhdd
        ]);
    }

    #[Route('hdd/ajouter', name: 'hdd.add')]
    public function AjouterHDD(Request $request,  EntityManagerInterface $manager): Response
    {   $hdd = new Hdd();
        $form_hdd = $this->createForm(HddFormType::class,$hdd);
        $form_hdd -> handleRequest($request);
    
        if( $form_hdd->isSubmitted() && $form_hdd->isValid()){
            
            $manager->persist($hdd);
            $manager->flush();

            return $this->redirectToRoute('hdd.show',['id'=> $hdd->getId()
            ]);
        }
        return $this->render('hdd/ajouterhdd.html.twig', [
            'controller_name' => 'HddController',
            'form_hdd' => $form_hdd->createView()
        ]);
    }

    #[Route('hdd/{id}', name: 'hdd.edit')]
    public function ModifierHDD(): Response
    {
        return $this->render('hdd/modifierhdd.html.twig', [
            'controller_name' => 'HddController',
        ]);
    }
}