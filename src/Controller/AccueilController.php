<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        $Prenom = 'Nathan';
        $Nom = 'Corberan';
        $Age = 19;
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'Prenom'=>$Prenom,
            'Nom'=> $Nom,
            'Age'=> $Age
        ]);
    }


    #[Route('/menu', name: 'app_Menu')]
    public function menu(): Response
    {
       
        return $this->render('mefo/menu.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    #[Route('/footer', name: 'app_Footer')]
    public function Footer(): Response
    {
       
        return $this->render('mefo/footer.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
