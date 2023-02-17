<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PortfolioController extends AbstractController
{
    #[Route('/', name: 'portfolio_index')]
    public function index(UserRepository $userRepository): Response
    {
        $user = $userRepository->find(2);

        return $this->render('portfolio/index.html.twig', [
            'user' => $user,
        ]);
    }
}
