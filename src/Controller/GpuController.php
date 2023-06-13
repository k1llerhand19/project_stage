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
    #[Route('/gpu', name: 'gpu.show')]
    public function index(GpuRepository $gpurepo): Response
    {   $showgpu = $gpurepo->findBy([],['id' => 'DESC']);

        return $this->render('gpu/index.html.twig', [
            'controller_name' => 'GPUController',
            'showgpu'=>$showgpu

        ]);
    }

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
            'controller_name' => 'GPUController',
            'form_gpu' => $form_gpu->createView()
        ]);
    }

    #[Route('gpu/{id}', name: 'gpu.edit')]
    public function ModifierGPU(): Response
    {
        return $this->render('gpu/modifiergpu.html.twig', [
            'controller_name' => 'AlimController',
        ]);
    }
}
