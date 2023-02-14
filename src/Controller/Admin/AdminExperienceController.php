<?php

namespace App\Controller\Admin;

use App\Repository\ExperienceRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminExperienceController extends AbstractController
{
    #[Route('/admin/experience', name: 'admin_experience_index')]
    public function index(ExperienceRepository $experienceRepository): Response
    {
        $userExperiences = $experienceRepository->findBy(["owner" => 2]);

        return $this->render('admin/experience_index.html.twig', [
            'userExperiences' => $userExperiences,
        ]);
    }
}
