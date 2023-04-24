<?php

namespace App\Service;

use App\Entity\Fruit;
use App\Entity\FruitFamily;
use App\Entity\FruitGenus;
use App\Entity\FruitOrder;
use App\Entity\Nutrition;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

class FruitService implements FruitServiceInterface
{
    private $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param $fruit
     * @return FruitOrder
     */
    public function createOrder($fruit): FruitOrder
    {
        $existingFruitOrder = $this->em->getRepository(FruitOrder::class)->findOneBy(['name' => $fruit['order']]);
        if ($existingFruitOrder) {
            return $existingFruitOrder;
        } else {
            $fruitOrder = new FruitOrder();
            $fruitOrder->setName($fruit['order']);
            $this->em->persist($fruitOrder);
        }
        $this->em->flush();

        return $fruitOrder;
    }

    /**
     * @param $fruit
     * @return FruitFamily
     */
    public function createFamily($fruit): FruitFamily
    {
        $thisFruitOrder = $this->createOrder($fruit);

        $existingFruitFamily = $this->em->getRepository(FruitFamily::class)->findOneBy(['name' => $fruit['family']]);
        if ($existingFruitFamily) {
            return $existingFruitFamily;
        } else {
            $fruitFamily = new FruitFamily();
            $fruitFamily->setName($fruit['family']);
            $fruitFamily->setFruitOrder($thisFruitOrder);
            $this->em->persist($fruitFamily);
        }
        $this->em->flush();

        return $fruitFamily;
    }

    /**
     * @param $fruit
     * @return FruitGenus
     */
    public function createGenus($fruit): FruitGenus
    {
        $fruitFamily = $this->createFamily($fruit);
        $existingFruitGenus = $this->em->getRepository(FruitGenus::class)->findOneBy(['name' => $fruit['genus']]);
        if ($existingFruitGenus) {
            return $existingFruitGenus;
        } else {
            $fruitGenus = new FruitGenus();
            $fruitGenus->setName($fruit['genus']);
            $fruitGenus->setFruitfamily($fruitFamily);
            $this->em->persist($fruitGenus);
        }
        $this->em->flush();

        return $fruitGenus;
    }

    /**
     * @param $fruit
     * @return Fruit
     */
    public function createFruit($fruit): Fruit
    {
        $fruitGene = $this->createGenus($fruit);
        $existingFruit = $this->em->getRepository(Fruit::class)->findOneBy(['name' => $fruit['name']]);
        if ($existingFruit) {
            return $existingFruit;
        } else {
            $fruitEntity = new Fruit();
            $fruitEntity->setName($fruit['name']);
            $fruitEntity->setFruitGenus($fruitGene);
            $this->em->persist($fruitEntity);
        }
        $this->em->flush();

        return $fruitEntity;
    }

    /**
     * @param $fruit
     * @return Nutrition
     */
    public function createNutrition($fruit): Nutrition
    {
        /*todo send a string name to all methods*/
        $newFruit = $this->createFruit($fruit);
        $existingNutrition = $newFruit->getNutrition();
        if ($existingNutrition != null) {
            return $existingNutrition;
        } else {
            $nutrition = new Nutrition();
            $nutrition->setFruit($newFruit);
            $nutrition->setCalories($fruit['nutritions']['calories']);
            $nutrition->setFat($fruit['nutritions']['fat']);
            $nutrition->setSugar($fruit['nutritions']['sugar']);
            $nutrition->setCarbohydrates($fruit['nutritions']['carbohydrates']);
            $nutrition->setProtein($fruit['nutritions']['protein']);
            $this->em->persist($nutrition);
            $this->em->flush();
        }

        return $nutrition;
    }
}
