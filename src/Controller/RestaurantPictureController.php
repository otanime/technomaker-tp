<?php

namespace App\Controller;

use App\Entity\RestaurantPicture;
use App\Repository\RestaurantPictureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantPictureController extends AbstractController
{
    private $restaurantPictureRepository;
    private $entityManager;

    public function __construct(RestaurantPictureRepository $restaurantPictureRepository, EntityManagerInterface $entityManager)
    {
        $this->$restaurantPictureRepository = $restaurantPictureRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     * @return Response
     * @Route("/restaurantPictures", name="restaurantPictures.list", methods={"GET"})
     *
     */
    public function getAll(): Response
    {
        $restaurantPictures = $this->restaurantPictureRepository->findAll();

        if (!$restaurantPictures) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        return $this->json([
            'restaurantPictures' => $restaurantPictures,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/restaurantPictures", name="restaurantPictures.list", methods={"POST"})
     *
     */
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $restaurantPicture = new RestaurantPicture();

        empty($data['name']) ? true : $restaurantPicture->setFilename($data['name']);
        empty($data['restaurant']) ? true : $restaurantPicture->setRestaurantId($data['restaurant']);

        $this->entityManager->persist($restaurantPicture);
        $this->entityManager->flush();

        return $this->json([
            '$restaurantPicture' => $restaurantPicture,
        ]);
    }


    /**
     * @param int $id
     * @return Response
     * @Route("/restaurantPictures/{id}", name="restaurantPictures.get", methods={"GET"}, requirements={"id"="\d+"})
     *
     */
    public function get(int $id): Response
    {
        $restaurantPicture = $this->restaurantPictureRepository->findOneBy(['id' => $id]);

        if (!$restaurantPicture) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        return $this->json([
            'restaurantPicture' => $restaurantPicture,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @Route("/restaurantPictures/{id}", name="restaurantPictures.update", methods={"PUT"}, requirements={"id"="\d+"})
     *
     */
    public function update(int $id, Request $request): Response
    {
        $restaurantPicture = $this->restaurantPictureRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        if (!$restaurantPicture) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        empty($data['name']) ? true : $restaurantPicture->setFilename($data['name']);
        empty($data['restaurant']) ? true : $restaurantPicture->setRestaurantId($data['restaurant']);

        $this->entityManager->persist($restaurantPicture);
        $this->entityManager->flush();

        return $this->json([
            'restaurantPicture' => $restaurantPicture,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @Route("/restaurantPictures/{id}", name="restaurantPictures.list", methods={"DELETE"}, requirements={"id"="\d+"})
     *
     */
    public function delete(int $id, Request $request): Response
    {
        $restaurantPicture = $this->restaurantPictureRepository->find($id);

        if (!$restaurantPicture) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        $this->entityManager->remove($restaurantPicture);
        $this->entityManager->flush();

        return $this->json([
            'msg' => 'yes',
        ]);
    }
}
