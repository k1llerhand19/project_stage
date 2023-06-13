<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Alimentation;
use App\Form\AlimentationFormType;
use App\Repository\AlimentationRepository;

class AlimController extends AbstractController

{
    #[Route('/alim', name: 'alim.show')]
    public function index(AlimentationRepository $alimrepo): Response
    {   //appel de tous les article
        $showalim = $alimrepo->findBy([],['id' => 'DESC']);
   
        return $this->render('alim/index.html.twig', [
        'controller_name' => 'AlimController',
        'showalim'=>$showalim
        ]);

    }

    #[Route('alim/ajouter', name: 'alim.add')]
    public function AjouterAlimRequest(Request $request,  EntityManagerInterface $manager): Response
    {   $alim = new Alimentation();
        $form_alim = $this->createForm(AlimentationFormType::class,$alim);
        $form_alim -> handleRequest($request);
    
        if( $form_alim->isSubmitted() && $form_alim->isValid()){
            
            $manager->persist($alim);
            $manager->flush();

            return $this->redirectToRoute('alim.show',['id'=> $alim->getId()
            ]);
        }


        return $this->render('alim/ajouteralim.html.twig', [
            'controller_name' => 'AlimController',
            'form_alim' => $form_alim->createView()
        ]);
    }

    #[Route('alim/{id}', name: 'alim.edit')]
    public function ModifierAlim(AlimentationRepository $alimrepo, Request $request, EntityManagerInterface $manager, $id): Response
    {          
        $alim = $alimrepo->find($id);
        
        if (!$alim) {
            throw $this->createNotFoundException('Données introuvables pour l\'ID '.$id);
        }

        $formalim = $this->createForm(AlimentationFormType::class, $alim);
        $formalim->handleRequest($request);

        if ($formalim->isSubmitted() && $formalim->isValid()) {
            $manager->flush();

            // Rediriger vers une page de confirmation ou une autre action
            return $this->redirectToRoute('alim.show');
        }

        return $this->render('alim/modifieralim.html.twig', [
            'controller_name' => 'AlimController', ['id' => $id],
            'formalim' => $formalim->createView(),
        ]);
    }

    
}