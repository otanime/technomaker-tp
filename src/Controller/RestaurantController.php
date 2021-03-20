<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\RestaurantType;
use App\Repository\RestaurantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    private $restaurantRepository;
    private $entityManager;

    private $session;

    public function __construct(RestaurantRepository $restaurantRepository, EntityManagerInterface $entityManager, SessionInterface $session)
    {
        $this->restaurantRepository = $restaurantRepository;
        $this->entityManager = $entityManager;
        $this->session = $session;
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

        $restaurant = new Restaurant();
        $form = $this->createForm(RestaurantType::class, $restaurant);

        return $this->render('restaurant/index.html.twig', [
            'restaurant' => $restaurant,
            'form' => $form->createView(),
            'ControllerName' => 'Gestion des restaurants',
            'restaurants' => $restaurants,
            'isForLimit' => false
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
        $restaurant = new Restaurant();

        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->persist($restaurant);
            $entityManager->flush();

            $this->session->getFlashBag()->add('success', 'Bien Ajouter');

            return $this->redirectToRoute('restaurants.list');

        }

        $this->session->getFlashBag()->add('error', 'Probléme declanché');

    }


    /**
     * @param int $id
     * @return Response
     * @Route("/restaurants/{id}", name="restaurants.show", methods={"GET"}, requirements={"id"="\d+"})
     *
     */
    public function show(int $id): Response
    {
        $restaurant = $this->restaurantRepository->findOneBy(['id' => $id]);

        if (!$restaurant) {
            throw $this->createNotFoundException('Aucun résultat');
        }


        $rating = $this->restaurantRepository->ratingAvg($id);

        return $this->render('restaurant/show.html.twig', [
            'restaurant' => $restaurant,
            'rating' => $rating,
            'ControllerName' => 'Afficher les infos de '.$restaurant->getName(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @Route("/restaurants/{id}/edit", name="restaurants.update", methods={"GET", "POST"}, requirements={"id"="\d+"})
     *
     */
    public function update(int $id, Request $request): Response
    {

        $restaurant = $this->restaurantRepository->findOneBy(['id' => $id]);

        if (!$restaurant) {
            throw $this->createNotFoundException('Aucun résultat');
        }

        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $this->session->getFlashBag()->add('success', 'Bien Modifier');

            return $this->redirectToRoute('restaurants.show', array('id' => $id));
        }

        return $this->render('restaurant/update.html.twig', [
            'restaurant' => $restaurant,
            'ControllerName' => 'modifier les infos de '.$restaurant->getName(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     * @Route("/restaurants/{id}/delete", name="restaurants.delete", methods={"GET"}, requirements={"id"="\d+"})
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

        $this->session->getFlashBag()->add('success', 'Bien suuprimer');

        return $this->redirectToRoute('restaurants.list');
    }

    /**
     * @param int $limit
     * @return Response
     * @Route("/restaurants/limit/{limit}", name="restaurants.last", methods={"GET"})
     *
     */
    public function getLast(int $limit): Response
    {

        if (!$limit)
            throw $this->createNotFoundException("La valeur pour limiter l'affichage pas definie");

        $restaurants = $this->restaurantRepository->lastRestaurants($limit);

        if (!$restaurants)
            throw $this->createNotFoundException('Aucun résultat');

        return $this->render('restaurant/index.html.twig', [
            'ControllerName' => "les $limit derniers restaurants créés",
            'restaurants' => $restaurants,
            'isForLimit' => true
        ]);
    }

    /**
     * @param int $limit
     * @return Response
     * @Route("/restaurants/top/{limit}", name="restaurants.top", methods={"GET"})
     *
     */
    public function getTop(int $limit): Response
    {

        if (!$limit)
            throw $this->createNotFoundException("La valeur pour limiter l'affichage pas definie");

        $restaurants = $this->restaurantRepository->topRestaurant($limit);

        if (!$restaurants)
            throw $this->createNotFoundException('Aucun résultat');

        return $this->render('restaurant/index.html.twig', [
            'ControllerName' => "les $limit top meilleurs restaurants",
            'restaurants' => $restaurants,
            'isForLimit' => true
        ]);
    }

    /**
     * @return Response
     * @Route("/restaurants/by-rating", name="restaurants.rating", methods={"GET"})
     *
     */
    public function classeByRating(): Response
    {

        $restaurants = $this->restaurantRepository->byRating();

        if (!$restaurants)
            throw $this->createNotFoundException('Aucun résultat');

        return $this->render('restaurant/index.html.twig', [
            'ControllerName' => "classer les restaurant pas vot",
            'restaurants' => $restaurants,
            'isForLimit' => true
        ]);
    }
}
