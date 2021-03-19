<?php

namespace App\Controller;

use App\Entity\City;
use App\Repository\CityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    private $cityRepository;
    private $entityManager;

    public function __construct(CityRepository $cityRepository, EntityManagerInterface $entityManager)
    {
        $this->$cityRepository = $cityRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     * @return Response
     * @Route("/cities", name="cities.list", methods={"GET"})
     *
     */
    public function getAll(): Response
    {
        $cites = $this->cityRepository->findAll();

        if (!$cites) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        return $this->json([
            'cities' => $cites,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/cities", name="cities.list", methods={"POST"})
     *
     */
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $city = new City();

        empty($data['name']) ? true : $city->setName($data['name']);
        empty($data['zipCode']) ? true : $city->setZipCode($data['zipCode']);

        $this->entityManager->persist($city);
        $this->entityManager->flush();

        return $this->json([
            '$cities' => $city,
        ]);
    }


    /**
     * @param int $id
     * @return Response
     * @Route("/cities/{id}", name="cities.get", methods={"GET"}, requirements={"id"="\d+"})
     *
     */
    public function get(int $id): Response
    {
        // $city = $this->cityRepository->find($id);
        $city = $this->cityRepository->findOneBy(['id' => $id]);

        if (!$city) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        return $this->json([
            'city' => $city,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @Route("/cities/{id}", name="cities.update", methods={"PUT"}, requirements={"id"="\d+"})
     *
     */
    public function update(int $id, Request $request): Response
    {
        $city = $this->cityRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        if (!$city) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        empty($data['name']) ? true : $city->setName($data['name']);
        empty($data['zipCode']) ? true : $city->setZipCode($data['zipCode']);

        $this->entityManager->persist($city);
        $this->entityManager->flush();

        return $this->json([
            'city' => $city,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @Route("/cities/{id}", name="cities.list", methods={"DELETE"}, requirements={"id"="\d+"})
     *
     */
    public function delete(int $id, Request $request): Response
    {
        $city = $this->cityRepository->find($id);

        if (!$city) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        $this->entityManager->remove($city);
        $this->entityManager->flush();

        return $this->json([
            'msg' => 'yes',
        ]);
    }
}
