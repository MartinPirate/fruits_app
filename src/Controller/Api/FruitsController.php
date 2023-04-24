<?php

namespace App\Controller\Api;

use App\Entity\Fruit;
use App\Entity\FruitOrder;
use App\Repository\FruitRepository;
use App\Traits\ApiResponseTrait;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class FruitsController extends AbstractController

{

    private EntityManagerInterface $entityManager;
    private SerializerInterface $serializer;

    private FruitRepository $repo;

    use ApiResponseTrait;


    public function __construct(EntityManagerInterface $entityManager, SerializerInterface $serializer, FruitRepository $repository)
    {
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
        $this->repo = $repository;
    }


    #[Route('/api/fruits', name: 'get-fruits', methods: ['GET'])]
    public function getFruits(): JsonResponse
    {
        $fruits = $this->repo->getFruits();

        return $this->apiResponse("Fruits retrieved successfully", $fruits, 200, []);

    }

    #[Route('/api/favourite-fruits', name: 'get-favourite-fruits', methods: ['GET'])]
    public function getFavouriteFruits(): JsonResponse
    {
        $favouriteFruits = $this->repo->getFavouriteFruits();

        return $this->apiResponse("Favourite Fruits retrieved successfully", $favouriteFruits, 200, []);

    }

    #[Route('/api/toggle_favourite/{id}', name: 'toggle_favourite', methods: ['POST'])]
    public function toggleFavouriteFruit(Request $request, Fruit $fruit): JsonResponse

    {
        $data = json_decode($request->getContent(), true);

        if (!$fruit) {
            throw $this->createNotFoundException('Fruit not found');
        }

        $favouriteFruits = $this->repo->getFavouriteFruitsCount();

        if ($favouriteFruits >= 10 && $data['isFavorite']) {
            return $this->apiErrorResponse("You can only have 10 favourite fruits", 400, []);
        }

        if (!isset($data['isFavorite'])) {
            return $this->apiErrorResponse("Please provide a value for isFavorite", 400, []);
        }

        if (!is_bool($data['isFavorite'])) {
            return $this->apiErrorResponse("Please provide a boolean value for isFavorite", 400, []);
        }

        $this->repo->toggleFavouriteFruit($fruit);


        $message = $data['isFavorite'] ? "Fruit Added to Favourites" : "Fruit Removed from Favourites";

        $fruit = $this->repo->getFruitById($fruit->getId());


        return $this->apiResponse($message, $fruit, 200, []);

    }

}