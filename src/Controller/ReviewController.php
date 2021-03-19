<?php

namespace App\Controller;

use App\Entity\Review;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    private $reviewRepository;
    private $entityManager;

    public function __construct(ReviewRepository $reviewRepository, EntityManagerInterface $entityManager)
    {
        $this->$reviewRepository = $reviewRepository;
        $this->entityManager = $entityManager;
    }

    /**
     *
     * @return Response
     * @Route("/reviews", name="reviews.list", methods={"GET"})
     *
     */
    public function getAll(): Response
    {
        $reviews = $this->reviewRepository->findAll();

        if (!$reviews) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        return $this->json([
            'reviews' => $reviews,
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/reviews", name="reviews.list", methods={"POST"})
     *
     */
    public function add(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        $review = new Review();

        empty($data['message']) ? true : $review->setMessage($data['message']);
        empty($data['rating']) ? true : $review->setRating($data['rating']);
        empty($data['user']) ? true : $review->setUserId($data['user']);
        empty($data['restaurant']) ? true : $review->setRestaurantId($data['restaurant']);

        $this->entityManager->persist($review);
        $this->entityManager->flush();

        return $this->json([
            '$review' => $review,
        ]);
    }


    /**
     * @param int $id
     * @return Response
     * @Route("/reviews/{id}", name="reviews.get", methods={"GET"}, requirements={"id"="\d+"})
     *
     */
    public function get(int $id): Response
    {
        // $review = $this->reviewRepository->find($id);
        $review = $this->reviewRepository->findOneBy(['id' => $id]);

        if (!$review) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        return $this->json([
            'review' => $review,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @Route("/reviews/{id}", name="reviews.update", methods={"PUT"}, requirements={"id"="\d+"})
     *
     */
    public function update(int $id, Request $request): Response
    {
        $review = $this->reviewRepository->findOneBy(['id' => $id]);
        $data = json_decode($request->getContent(), true);

        if (!$review) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        empty($data['message']) ? true : $review->setMessage($data['message']);
        empty($data['rating']) ? true : $review->setRating($data['rating']);
        empty($data['user']) ? true : $review->setUserId($data['user']);
        empty($data['restaurant']) ? true : $review->setRestaurantId($data['restaurant']);

        $this->entityManager->persist($review);
        $this->entityManager->flush();

        return $this->json([
            'review' => $review,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @Route("/reviews/{id}", name="reviews.list", methods={"DELETE"}, requirements={"id"="\d+"})
     *
     */
    public function delete(int $id, Request $request): Response
    {
        $review = $this->reviewRepository->find($id);

        if (!$review) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        $this->entityManager->remove($review);
        $this->entityManager->flush();

        return $this->json([
            'msg' => 'yes',
        ]);
    }
}
