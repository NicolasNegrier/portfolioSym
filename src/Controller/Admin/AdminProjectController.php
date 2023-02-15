<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProjectController extends AbstractController
{
    protected $projectRepository;
    protected $em;

    public function __construct(ProjectRepository $projectRepository, EntityManagerInterface $em)
    {
        $this->projectRepository = $projectRepository;
        $this->em = $em;
    }

    #[Route('/admin/project', name: 'admin_project_index')]
    public function index(): Response
    {
        $projects = $this->projectRepository->findAll();

        return $this->render('admin/admin_project/index.html.twig', [
            'projects' => $projects,
        ]);
    }

    #[Route('/admin/project/create', name: 'admin_project_create')]
    public function create(Request $request, UserRepository $userRepository): Response
    {
        $project = new Project;
        $user = $userRepository->find(2);

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $project->setOwner($user);
            $this->em->persist($project);
            $this->em->flush();

            return $this->redirectToRoute('admin_project_index');
        }

        $formView = $form->createView();

        return $this->render('admin/admin_project/create.html.twig', [
            'formView' => $formView
        ]);
    }

    #[Route('/admin/project/{id}', name: 'admin_project_show')]
    public function show($id): Response
    {
        $project = $this->projectRepository->find($id);

        return $this->render('admin/admin_project/show.html.twig', [
            'project' => $project,
        ]);
    }

    #[Route('/admin/project/{id}/edit', name: 'admin_project_edit')]
    public function edit($id, Request $request): Response
    {
        $project = $this->projectRepository->find($id);

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $this->em->flush();

            return $this->redirectToRoute('admin_project_show', [
                'id' => $project->getId()
            ]);
        }

        $formView = $form->createView();

        return $this->render('admin/admin_project/edit.html.twig', [
            'project' => $project,
            'formView' => $formView
        ]);
    }
}
