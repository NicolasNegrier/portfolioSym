<?php

namespace App\Controller\Admin;

use App\Entity\Reseau;
use App\Form\ReseauType;
use App\Repository\ReseauRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminReseauController extends AbstractController
{
    protected $reseauRepository;
    protected $em;

    public function __construct(ReseauRepository $reseauRepository, EntityManagerInterface $em)
    {
        $this->reseauRepository = $reseauRepository;
        $this->em = $em;
    }

    #[Route('/admin/reseau', name: 'admin_reseau_index')]
    public function index(): Response
    {
        $reseaux = $this->reseauRepository->findAll();

        return $this->render('admin/admin_reseau/index.html.twig', [
            'reseaux' => $reseaux,
        ]);
    }

    #[Route('/admin/reseau/create', name: 'admin_reseau_create')]
    public function create(Request $request, UserRepository $userRepository): Response
    {
        $reseau = new Reseau;
        $user = $userRepository->find(2);

        $form = $this->createForm(ReseauType::class, $reseau);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // Renseignement du owner
            $reseau->setOwner($user);
            $this->em->persist($reseau);
            $this->em->flush();

            return $this->redirectToRoute('admin_reseau_index');
        }

        $formView = $form->createView();

        return $this->render('admin/admin_reseau/create.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/admin/reseau/{id}', name: 'admin_reseau_show')]
    public function show($id): Response
    {
        $reseau = $this->reseauRepository->find($id);

        return $this->render('admin/admin_reseau/show.html.twig', [
            'reseau' => $reseau,
        ]);
    }

    #[Route('/admin/reseau/{id}/edit', name: 'admin_reseau_edit')]
    public function edit($id, Request $request): Response
    {
        $reseau = $this->reseauRepository->find($id);

        $form = $this->createForm(ReseauType::class, $reseau);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $this->em->flush();

            return $this->redirectToRoute('admin_reseau_show', [
                'id' => $reseau->getId()
            ]);
        }

        $formView = $form->createView();

        return $this->render('admin/admin_reseau/edit.html.twig', [
            'formView' => $formView,
            'reseau' => $reseau
        ]);
    }
}
