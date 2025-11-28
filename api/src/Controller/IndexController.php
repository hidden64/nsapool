<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;

final class IndexController extends AbstractController
{
    #[Route('/api/user', name: 'app_create_user', methods: ['POST'])]

    public function userCreateApi(EntityManagerInterface $entityManager): JsonResponse
    {
        $user = new User();

        $user->setPassword("toto4242");
        $user->setRoles(["ROLE_USER"]);
        $user->setUsername("Marvin42");
        $user->setEmail("marvin@epitech.eu");
        $entityManager->persist($user);
        $entityManager->flush();
        return $this->json([], 201);
    }


    #[Route('/api/user', name: 'app_display_users', methods: ['GET', 'HEAD'])]
    public function userDisplayApi(EntityManagerInterface $entityManager)
    {
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => "marvin@epitech.eu"]);
        $data = [];
        if ($user){
            $data['email'] = $user->getEmail();
            $data['username'] = $user->getUsername();
            $data['roles'] = $user->getRoles();
            return ($this->json($data, 201));
        }
        return ($this->json([], 404));
    }
}



