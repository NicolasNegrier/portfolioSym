<?php

namespace App\Controller;

use App\Repository\TechnoCatRepository;
use App\Repository\TechnoRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    #[Route('/', name: 'portfolio_index')]
    public function index(UserRepository $userRepository, TechnoCatRepository $technoCatRepository): Response
    {
        $user = $userRepository->find(2);
        $technoCats = $technoCatRepository->findAll();

        return $this->render('portfolio/index.html.twig', [
            'user' => $user,
            'technoCats' => $technoCats
        ]);
    }
}
