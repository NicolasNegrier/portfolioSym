<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminProjectController extends AbstractController
{
    #[Route('/admin/project', name: 'app_admin_project')]
    public function index(): Response
    {
        return $this->render('admin_project/index.html.twig', [
            'controller_name' => 'AdminProjectController',
        ]);
    }
}
