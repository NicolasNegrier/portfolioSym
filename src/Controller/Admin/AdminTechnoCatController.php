<?php

namespace App\Controller\Admin;

use App\Entity\TechnoCat;
use App\Form\TechnoCatType;
use App\Repository\TechnoCatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTechnoCatController extends AbstractController
{
    #[Route('/admin/techno/cat', name: 'admin_techno_cat_index')]
    public function index(TechnoCatRepository $technoCatRepository): Response
    {
        $categories = $technoCatRepository->findAll();

        return $this->render('admin/admin_techno_cat/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    #[Route('/admin/techno/cat/create', name: 'admin_techno_cat_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $categorie = new TechnoCat;

        $form = $this->createForm(TechnoCatType::class, $categorie);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em->persist($categorie);
            $em->flush();

            return $this->redirectToRoute('admin_techno_cat_index');
        }

        $formView = $form->createView();

        return $this->render('admin/admin_techno_cat/create.html.twig', [
            'formView' => $formView,
        ]);
    }
}
