<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    private $restaurantRepository;
    private $entityManager;

    public function __construct(RestaurantRepository $restaurantRepository, EntityManagerInterface $entityManager)
    {
        $this->restaurantRepository = $restaurantRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     * @return Response
     * @Route("/restaurants", name="restaurants.list", methods={"GET"})
     *
     */
    public function getAll(): Response
    {
        $restaurants = $this->restaurantRepository->findAll();

        if (!$restaurants) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        return $this->json([
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/restaurants", name="restaurants.add", methods={"POST"})
     *
     */
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $restaurant = new Restaurant();

        empty($data['name']) ? true : $restaurant->setName($data['name']);
        empty($data['description']) ? true : $restaurant->setDescription($data['description']);
        empty($data['city']) ? true : $restaurant->setCityId($data['city']);

        $this->entityManager->persist($restaurant);
        $this->entityManager->flush();

        return $this->json([
            '$restaurant' => $restaurant,
        ]);
    }


    /**
     * @param int $id
     * @return Response
     * @Route("/restaurants/{id}", name="restaurants.show", methods={"GET"}, requirements={"id"="\d+"})
     *
     */
    public function show(int $id): Response
    {
        // $restaurant = $this->restaurantRepository->find($id);
        $restaurant = $this->restaurantRepository->findOneBy(['id' => $id]);

        if (!$restaurant) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        return $this->json([
            'restaurant' => $restaurant,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @Route("/restaurants/{id}", name="restaurants.update", methods={"PUT"}, requirements={"id"="\d+"})
     *
     */
    public function update(int $id, Request $request): Response
    {
        $restaurant = $this->restaurantRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        if (!$restaurant) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        empty($data['name']) ? true : $restaurant->setName($data['name']);
        empty($data['description']) ? true : $restaurant->setDescription($data['description']);
        empty($data['city']) ? true : $restaurant->setCityId($data['city']);

        $this->entityManager->persist($restaurant);
        $this->entityManager->flush();

        return $this->json([
            'restaurant' => $restaurant,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @Route("/restaurants/{id}", name="restaurants.delete", methods={"DELETE"}, requirements={"id"="\d+"})
     *
     */
    public function delete(int $id, Request $request): Response
    {
        $restaurant = $this->restaurantRepository->find($id);

        if (!$restaurant) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        $this->entityManager->remove($restaurant);
        $this->entityManager->flush();

        return $this->json([
            'msg' => 'yes',
        ]);
    }
}
