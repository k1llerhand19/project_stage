<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Ordinateur;
use App\Form\OrdinateurFormType;
use App\Repository\OrdinateurRepository;


class OrdinateurController extends AbstractController
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //afficher
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('/ordinateur', name: 'ordinateur.show')]
    public function index(ManagerRegistry $registry): Response
    {        
        $ordi = $registry->getManager()->getRepository(Ordinateur::class)->createQueryBuilder('o')
            ->select('o.nom, o.marque, o.modele, a.nom as alim_nom', 'b.nom as boitier_nom', 'c.nom as cartemere_nom', 'cp.nom as cpu_nom', 'g.nom as gpu_nom', 'h.nom as hdd_nom', 'ra.nom as ram_nom', 're.nom as refroidisseur_nom', 's.nom as ssd_nom')
            ->join('o.alim', 'a')
            ->join('o.boitier', 'b')
            ->join('o.cartemere', 'c')
            ->join('o.cpu', 'cp')
            ->join('o.gpu', 'g')
            ->join('o.hdd', 'h')
            ->join('o.ram', 'ra')
            ->join('o.refroidisseur', 're')
            ->join('o.ssd', 's')
            ->orderBy('o.id', 'DESC')
            ->getQuery()
            ->getResult();

        return $this->render('ordinateur/index.html.twig', [
            'showordi' => $ordi
        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Ajouter
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('ordinateur/ajouter', name: 'ordinateur.add')]
    public function AjouterOrdinateur(Request $request,  EntityManagerInterface $manager): Response
    {
        $ordinateur = new Ordinateur();
        $form_ordinateur = $this->createForm(OrdinateurFormType::class,$ordinateur);
        $form_ordinateur -> handleRequest($request);
    
        if( $form_ordinateur->isSubmitted() && $form_ordinateur->isValid()){
            
            $manager->persist($ordinateur);
            $manager->flush();

            return $this->redirectToRoute('ordinateur.show',['id'=> $ordinateur->getId()
            ]);
        }

        return $this->render('ordinateur/ajouterordinateur.html.twig', [
            'form_ordinateur'=> $form_ordinateur->createView()

        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Modifier
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('ordinateur/{id}', name: 'ordinateur.edit')]
    public function ModifierOrdinateur(Ordinateur $ordinateur,Request $request,  EntityManagerInterface $manager): Response
    {
            $formordi = $this->createForm(OrdinateurFormType::class, $ordinateur);
            $formordi->handleRequest($request);
    
            if ($formordi->isSubmitted() && $formordi->isValid()) {
                $manager->persist($ordinateur);
                $manager->flush();
    
                // Rediriger vers une page de confirmation ou une autre action
                return $this->redirectToRoute('ordinateur.show');
            }

        return $this->render('ordinateur/modifierordinateur.html.twig', [
            'formordi' => $formordi->createView(),
        ]);
    }
}
