<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Refroidisseur;
use App\Form\RefroidisseurFormType;
use App\Repository\RefroidisseurRepository;

class RefroidisseurController extends AbstractController
{
    #[Route('/ventiradaio', name: 'ventiradaio.show')]
    public function index(RefroidisseurRepository $refroidisseurrepo): Response
    {
        $showrefroidisseur = $refroidisseurrepo->findBy([],['id' => 'DESC']);

        return $this->render('refroidisseur/index.html.twig', [
            'showrefroidisseur'=>$showrefroidisseur
        ]);
    }




    #[Route('ventiradaio/ajouter', name: 'ventiradaio.add')]
    public function AjouterVentiradAIO(Request $request,  EntityManagerInterface $manager): Response
    {
        $Refroidisseur = new Refroidisseur();
        $form_Refroidisseur = $this->createForm(RefroidisseurFormType::class, $Refroidisseur);
        $form_Refroidisseur -> handleRequest($request);

        if( $form_Refroidisseur->isSubmitted() && $form_Refroidisseur->isValid()){
            $manager->persist($Refroidisseur);
            $manager->flush();

            return $this->redirectToRoute('ssd.show',['id'=>$Refroidisseur->getId()]);
        }
        return $this->render('refroidisseur/ajouterrefroidisseur.html.twig', [
            'form_Refroidisseur'=> $form_Refroidisseur->createView()

        ]);

    }




    #[Route('ventiradaio/{id}', name: 'ventiradaio.edit')]
    public function ModifierVentiradAIO(): Response
    {
        return $this->render('refroidisseur/modifierrefroidisseur.html.html.twig', [
        ]);
    }
}
