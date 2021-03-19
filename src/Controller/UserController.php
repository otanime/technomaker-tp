<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{

    private $userRepository;
    private $entityManager;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->$userRepository = $userRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     * @return Response
     * @Route("/users", name="users.list", methods={"GET"})
     *
     */
    public function getAll(): Response
    {
        $users = $this->userRepository->findAll();

        if (!$users) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        return $this->json([
            'users' => $users,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/users", name="users.list", methods={"POST"})
     *
     */
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $user = new User();

        empty($data['username']) ? true : $user->setUsername($data['username']);
        empty($data['password']) ? true : $user->setPassword($data['password']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->json([
            '$user' => $user,
        ]);
    }


    /**
     * @param int $id
     * @return Response
     * @Route("/users/{id}", name="users.get", methods={"GET"}, requirements={"id"="\d+"})
     *
     */
    public function get(int $id): Response
    {
        // $user = $this->userRepository->find($id);
        $user = $this->userRepository->findOneBy(['id' => $id]);

        if (!$user) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        return $this->json([
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @Route("/users/{id}", name="users.update", methods={"PUT"}, requirements={"id"="\d+"})
     *
     */
    public function update(int $id, Request $request): Response
    {
        $user = $this->userRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        if (!$user) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        empty($data['username']) ? true : $user->setUsername($data['username']);
        empty($data['password']) ? true : $user->setPassword($data['password']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->json([
            'user' => $user,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @Route("/users/{id}", name="users.list", methods={"DELETE"}, requirements={"id"="\d+"})
     *
     */
    public function delete(int $id, Request $request): Response
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        $this->entityManager->remove($user);
        $this->entityManager->flush();

        return $this->json([
            'msg' => 'yes',
        ]);
    }


}
