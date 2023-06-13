<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use App\Entity\Gpu;
use App\Form\GpuFormType;
use App\Repository\GpuRepository;

class GpuController extends AbstractController
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //afficher
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('/gpu', name: 'gpu.show')]
    public function index(GpuRepository $gpurepo): Response
    {   $showgpu = $gpurepo->findBy([],['id' => 'DESC']);

        return $this->render('gpu/index.html.twig', [
            'showgpu'=>$showgpu

        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Ajouter
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('gpu/ajouter', name: 'gpu.add')]
    public function AjouterGPU(Request $request,  EntityManagerInterface $manager): Response
    {
        $gpu = new Gpu();
        $form_gpu = $this->createForm(GpuFormType::class,$gpu);
        $form_gpu -> handleRequest($request);
    
        if( $form_gpu->isSubmitted() && $form_gpu->isValid()){
            
            $manager->persist($gpu);
            $manager->flush();

            return $this->redirectToRoute('gpu.show',['id'=> $gpu->getId()
            ]);
        }

        return $this->render('gpu/ajoutergpu.html.twig', [
            'form_gpu' => $form_gpu->createView()
        ]);
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Modifier
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    #[Route('gpu/{id}', name: 'gpu.edit')]
    public function ModifierGPU(Gpu $gpu, Request $request, EntityManagerInterface $manager): Response
    {

        $formgpu = $this->createForm(GpuFormType::class, $gpu);
        $formgpu->handleRequest($request);

        if ($formgpu->isSubmitted() && $formgpu->isValid()) {
            $manager->persist($gpu);
            $manager->flush();

            // Rediriger vers une page de confirmation ou une autre action
            return $this->redirectToRoute('gpu.show');
        }
        return $this->render('gpu/modifiergpu.html.twig', [
            'formgpu' => $formgpu->createView(),
        ]);
    }
}
