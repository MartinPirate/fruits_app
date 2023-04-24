<?php

namespace App\Service;

use App\Entity\Fruit;
use App\Entity\FruitFamily;
use App\Entity\FruitGenus;
use App\Entity\FruitOrder;
use App\Entity\Nutrition;

interface FruitServiceInterface
{
    public function createOrder(array $fruit): FruitOrder;

    public function createFamily(array $fruit): FruitFamily;

    public function createGenus(array $fruit): FruitGenus;

    public function createFruit(array $fruit): Fruit;

    public function createNutrition(array $fruit): Nutrition;


}
