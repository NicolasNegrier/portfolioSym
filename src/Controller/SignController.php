<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SignController extends AbstractController
{
    #[Route('/sign', name: 'sign_index')]
    public function index(EntityManagerInterface $em, UserPasswordHasherInterface $encoder): Response
    {
        $user = new User;

        $hash = $encoder->hashPassword($user, "Nico3583");

        $user->setEmail("nicolas.negrier@gmail.com")
            ->setFirstname("Nicolas")
            ->setName("NEGRIER")
            ->setPassword($hash)
            ->setRoles(['ROLE_ADMIN']);

        $em->persist($user);

        $em->flush();

        return $this->render('sign/index.html.twig', [
            'user' => $user,
        ]);
    }
}
