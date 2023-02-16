<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    protected $userRepository;
    protected $em;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    #[Route('/admin', name: 'admin_index')]
    public function index(): Response
    {
        $user = $this->userRepository->find(2);

        return $this->render('admin/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/admin/edit', name: 'admin_edit')]
    public function edit(Request $request): Response
    {
        $user = $this->userRepository->find(2);

        if (!$user) {
            $user = new User;
            $user->setRoles(['ROLE_ADMIN']);
        }

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $this->em->persist($user);
            $this->em->flush();

            return $this->redirectToRoute('admin_index');
        }
        $formView = $form->createView();

        return $this->render('admin/edit.html.twig', [
            'user' => $user,
            'formView' => $formView
        ]);
    }
}
