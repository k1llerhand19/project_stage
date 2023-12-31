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

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //afficher
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('/alim', name: 'alim.show')]
    public function index(AlimentationRepository $alimrepo): Response
    {   //appel de tous les article
        $showalim = $alimrepo->findBy([],['id' => 'DESC']);
   
        return $this->render('alim/index.html.twig', [
        'showalim'=>$showalim
        ]);

    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Ajouter
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


    #[Route('alim/ajouter', name: 'alim.add')]
    public function AjouterAlimRequest(Request $request,  EntityManagerInterface $manager): Response
    {   $alim = new Alimentation();
        $form_alim = $this->createForm(AlimentationFormType::class,$alim);
        $form_alim -> handleRequest($request);
    
        if( $form_alim->isSubmitted() && $form_alim->isValid()){
            
            $manager->persist($alim);
            $manager->flush();

            return $this->redirectToRoute('alim.show',[
            ]);
        }


        return $this->render('alim/ajouteralim.html.twig', [
            'form_alim' => $form_alim->createView()
        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Supprimer
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    #[Route('alim/{id}', name: 'alim.delete', methods: ['DELETE'])]
    public function delete(Alimentation $alimentation, EntityManagerInterface $entityManager, Request $request): Response
    {
        if($this->isCsrfTokenValid('delete'.$alimentation->getId(), $request->get('_token')))
        {
            $entityManager->remove($alimentation);
            $entityManager->flush();

            //$this->addFlash('success', "Le serveur a bien été supprimé !");
        }

        return $this->redirectToRoute('alim.show');
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Modifier
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('alim/{id}', name: 'alim.edit', methods: ['GET', 'POST'])]
    public function ModifierAlim(Alimentation $alimentation, Request $request, EntityManagerInterface $manager): Response
    {          
        $formalim = $this->createForm(AlimentationFormType::class, $alimentation);
        $formalim->handleRequest($request);

        if ($formalim->isSubmitted() && $formalim->isValid()) {
            $manager->persist($alimentation);
            $manager->flush();

            // Rediriger vers une page de confirmation ou une autre action
            return $this->redirectToRoute('alim.show');
        }

        return $this->render('alim/modifieralim.html.twig', [
            'formalim' => $formalim->createView(),
        ]);
    }


    

    
}