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
    #[Route('/ordinateur', name: 'ordinateur.show')]
    public function index(ManagerRegistry $registry): Response
    {        
        $ordi = $registry->getManager()->getRepository(Ordinateur::class)->createQueryBuilder('o')
            ->select('a.nom as alim_nom', 'b.nom as boitier_nom', 'c.nom as cartemere_nom', 'cp.nom as cpu_nom', 'g.nom as gpu_nom', 'h.nom as hdd_nom', 'ra.nom as ram_nom', 're.nom as refroidisseur_nom', 's.nom as ssd_nom')
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
            'controller_name' => 'OrdinateurController',
            'showordi' => $ordi
        ]);
    }



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
            'controller_name' => 'OrdinateurController',
            'form_ordinateur'=> $form_ordinateur->createView()

        ]);
    }




    #[Route('ordinateur/{id}', name: 'ordinateur.edit')]
    public function ModifierOrdinateur(): Response
    {
        return $this->render('ordinateur/modifierordinateur.html.twig', [
            'controller_name' => 'OrdinateurController',
        ]);
    }
}
