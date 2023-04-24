<?php

namespace App\Tests\Service;

use App\Entity\Fruit;
use App\Entity\FruitFamily;
use App\Entity\FruitGenus;
use App\Entity\FruitOrder;
use App\Entity\Nutrition;
use App\Service\FruitService;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class FruitServiceTest extends TestCase
{
    private $entityManager;
    private $fruitService;

    protected function setUp(): void
    {
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        $this->fruitService = new FruitService($this->entityManager);
    }

    public function testCreateOrder(): void
    {
        $fruit = ['order' => 'Apple'];
        $fruitOrder = new FruitOrder();
        $fruitOrder->setName('Apple');

        $this->entityManager
            ->expects($this->once())
            ->method('getRepository')
            ->with(FruitOrder::class)
            ->willReturn($this->createMock(FruitOrder::class));

        $this->entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($fruitOrder);

        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $result = $this->fruitService->createOrder($fruit);

        $this->assertInstanceOf(FruitOrder::class, $result);
        $this->assertEquals('Apple', $result->getName());
    }

    public function testCreateFamily(): void
    {
        $fruit = ['order' => 'Apple', 'family' => 'Golden Delicious'];
        $fruitFamily = new FruitFamily();
        $fruitFamily->setName('Golden Delicious');

        $this->entityManager
            ->expects($this->exactly(2))
            ->method('getRepository')
            ->withConsecutive(
                [FruitOrder::class],
                [FruitFamily::class]
            )
            ->will($this->onConsecutiveCalls(
                $this->createMock(FruitOrder::class),
                $this->createMock(FruitFamily::class)
            ));

        $this->entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($fruitFamily);

        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $result = $this->fruitService->createFamily($fruit);

        $this->assertInstanceOf(FruitFamily::class, $result);
        $this->assertEquals('Golden Delicious', $result->getName());
    }

    public function testCreateGenus(): void
    {
        $fruit = ['order' => 'Apple', 'family' => 'Golden Delicious', 'genus' => 'Malus'];
        $fruitGenus = new FruitGenus();
        $fruitGenus->setName('Malus');

        $this->entityManager
            ->expects($this->exactly(3))
            ->method('getRepository')
            ->withConsecutive(
                [FruitOrder::class],
                [FruitFamily::class],
                [FruitGenus::class]
            )
            ->will($this->onConsecutiveCalls(
                $this->createMock(FruitOrder::class),
                $this->createMock(FruitFamily::class),
                $this->createMock(FruitGenus::class)
            ));

        $this->entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($fruitGenus);

        $this->entityManager
            ->expects($this->once())
            ->method('flush');

        $result = $this->fruitService->createGenus($fruit);

        $this->assertInstanceOf(FruitGenus::class, $result);
        $this->assertEquals('Malus', $result->getName());
    }
}

