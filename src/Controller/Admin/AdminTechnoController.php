<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminTechnoController extends AbstractController
{
    #[Route('/admin/techno', name: 'app_admin_techno')]
    public function index(): Response
    {
        return $this->render('admin_techno/index.html.twig', [
            'controller_name' => 'AdminTechnoController',
        ]);
    }
}
