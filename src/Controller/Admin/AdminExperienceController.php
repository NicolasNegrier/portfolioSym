<?php

namespace App\Controller\Admin;

use App\Entity\Experience;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminExperienceController extends AbstractController
{
    protected $experienceRepository;
    protected $em;

    public function __construct(ExperienceRepository $experienceRepository, EntityManagerInterface $em)
    {
        $this->experienceRepository = $experienceRepository;
        $this->em = $em;
    }

    #[Route('/admin/experience', name: 'admin_experience_index')]
    public function index(): Response
    {
        $experiences = $this->experienceRepository->findBy(["owner" => 2]);

        return $this->render('admin/admin_experience/index.html.twig', [
            'experiences' => $experiences,
        ]);
    }

    #[Route('/admin/experience/create', name: 'admin_experience_create')]
    public function create(Request $request, UserRepository $userRepository): Response
    {
        $experience = new Experience;
        $user = $userRepository->find(2);

        $form = $this->createForm(ExperienceType::class, $experience);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            // Renseignement du owner
            $experience->setOwner($user);
            $this->em->persist($experience);
            $this->em->flush();

            return $this->redirectToRoute('admin_experience_index');
        }

        $formView = $form->createView();

        return $this->render('admin/admin_experience/create.html.twig', [
            'formView' => $formView,
        ]);
    }

    #[Route('/admin/experience/{id}', name: 'admin_experience_show')]
    public function show($id, Request $request): Response
    {
        $experience = $this->experienceRepository->find($id);

        return $this->render('admin/admin_experience/show.html.twig', [
            'experience' => $experience,
        ]);
    }

    #[Route('/admin/experience/{id}/edit', name: 'admin_experience_edit')]
    public function edit($id, Request $request): Response
    {
        $experience = $this->experienceRepository->find($id);

        $form = $this->createForm(ExperienceType::class, $experience);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $this->em->flush();

            return $this->redirectToRoute('admin_experience_show', [
                'id' => $experience->getId()
            ]);
        }

        $formView = $form->createView();

        return $this->render('admin/admin_experience/edit.html.twig', [
            'formView' => $formView,
            'experience' => $experience
        ]);
    }
}
