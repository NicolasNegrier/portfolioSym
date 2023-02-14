<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminReseauController extends AbstractController
{
    #[Route('/admin/reseau', name: 'app_admin_reseau')]
    public function index(): Response
    {
        return $this->render('admin_reseau/index.html.twig', [
            'controller_name' => 'AdminReseauController',
        ]);
    }
}
