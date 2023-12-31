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
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //afficher
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('/hdd', name: 'hdd.show')]
    public function index(HddRepository $hddrepo): Response
    {   
        $showhdd = $hddrepo->findBy([],['id' => 'DESC']);

        return $this->render('hdd/index.html.twig', [
            'showhdd'=>$showhdd
        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Ajouter
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

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
            'form_hdd' => $form_hdd->createView()
        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Supprimer
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    #[Route('hdd/{id}', name: 'hdd.delete', methods: ['DELETE'])]
    public function delete(Hdd $hdd, EntityManagerInterface $entityManager, Request $request): Response
    {
        if($this->isCsrfTokenValid('delete'.$hdd->getId(), $request->get('_token')))
        {
            $entityManager->remove($hdd);
            $entityManager->flush();

            //$this->addFlash('success', "Le serveur a bien été supprimé !");
        }

        return $this->redirectToRoute('hdd.show');
    }
 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Modifier
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('hdd/{id}', name: 'hdd.edit', methods: ['GET', 'POST'])]
    public function ModifierHDD(Hdd $hdd, Request $request, EntityManagerInterface $manager): Response
    {

        $formhdd = $this->createForm(HddFormType::class, $hdd);
        $formhdd->handleRequest($request);

        if ($formhdd->isSubmitted() && $formhdd->isValid()) {
            $manager->persist($hdd);
            $manager->flush();

            // Rediriger vers une page de confirmation ou une autre action
            return $this->redirectToRoute('hdd.show');
        }
        return $this->render('hdd/modifierhdd.html.twig', [
            'formhdd' => $formhdd->createView(),
        ]);
    }
}