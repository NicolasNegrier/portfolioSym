<?php

namespace App\Controller\Admin;

use App\Entity\Techno;
use App\Form\TechnoType;
use App\Repository\TechnoRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTechnoController extends AbstractController
{
    protected $technoRepository;
    protected $em;

    public function __construct(TechnoRepository $technoRepository, EntityManagerInterface $em)
    {
        $this->technoRepository = $technoRepository;
        $this->em = $em;
    }

    #[Route('/admin/techno', name: 'admin_techno_index')]
    public function index(): Response
    {
        $technos = $this->technoRepository->findAll();

        return $this->render('admin/admin_techno/index.html.twig', [
            'technos' => $technos,
        ]);
    }

    #[Route('/admin/techno/create', name: 'admin_techno_create')]
    public function create(Request $request, UserRepository $userRepository): Response
    {
        $techno = new Techno;
        $user = $userRepository->find(2);

        $form = $this->createForm(TechnoType::class, $techno);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $techno->setOwner($user);
            $this->em->persist($techno);
            $this->em->flush();

            return $this->redirectToRoute('admin_techno_index');
        }

        $formView = $form->createView();

        return $this->render('admin/admin_techno/create.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/admin/techno/{id}', name: 'admin_techno_show')]
    public function show($id): Response
    {
        $techno = $this->technoRepository->find($id);

        return $this->render('admin/admin_techno/show.html.twig', [
            'techno' => $techno,
        ]);
    }

    #[Route('/admin/techno/{id}/edit', name: 'admin_techno_edit')]
    public function edit($id, Request $request): Response
    {
        $techno = $this->technoRepository->find($id);

        $form = $this->createForm(TechnoType::class, $techno);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $this->em->persist($techno);
            $this->em->flush();

            return $this->redirectToRoute('admin_techno_show', [
                'id' => $techno->getId()
            ]);
        }

        $formView = $form->createView();

        return $this->render('admin/admin_techno/edit.html.twig', [
            'formView' => $formView,
            'techno' => $techno
        ]);
    }
}
