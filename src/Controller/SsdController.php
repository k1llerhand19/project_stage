<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Ssd;
use App\Form\SsdFormType;
use App\Repository\SsdRepository;

class SsdController extends AbstractController
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //afficher
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('/ssd', name: 'ssd.show')]
    public function index(SsdRepository $ssdrepo): Response
    {
        $showssd = $ssdrepo->findBy([],['id' => 'DESC']);
        return $this->render('ssd/index.html.twig', [
            'showssd'=>$showssd
        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Ajouter
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('ssd/ajouter', name: 'ssd.add')]
    public function AjouterSSD(Request $request,  EntityManagerInterface $manager): Response
    {
        $ssd = new Ssd();
        $form_ssd = $this->createForm(SsdFormType::class, $ssd);
        $form_ssd -> handleRequest($request);

        if( $form_ssd->isSubmitted() && $form_ssd->isValid()){
            $manager->persist($ssd);
            $manager->flush();

            return $this->redirectToRoute('ssd.show',['id'=>$ssd->getId()]);
        }
        return $this->render('ssd/ajouterssd.html.twig', [
            'form_ssd'=> $form_ssd->createView()
        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Modifier
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('ssd/{id}', name: 'ssd.edit')]
    public function ModifierSSD(SsdRepository $ssdrepo, Request $request, EntityManagerInterface $manager, $id): Response
    {
        $ssd = $ssdrepo->find($id);

        if (!$ssd) {
            throw $this->createNotFoundException('Données introuvables pour l\'ID '.$id);
        }

        $formssd = $this->createForm(SsdFormType::class, $ssd);
        $formssd->handleRequest($request);

        if ($formssd->isSubmitted() && $formssd->isValid()) {
            $manager->flush();

            // Rediriger vers une page de confirmation ou une autre action
            return $this->redirectToRoute('ssd.show');
        }
        return $this->render('ssd/modifierssd.html.twig', [
            ['id' => $id],
            'formssd' => $formssd->createView(),
        ]);
    }
}
