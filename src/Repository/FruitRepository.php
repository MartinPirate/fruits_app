<?php

namespace App\Repository;

use App\Entity\Fruit;
use App\Traits\ApiResponseTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * @extends ServiceEntityRepository<Fruit>
 *
 * @method Fruit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fruit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fruit[]    findAll()
 * @method Fruit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FruitRepository extends ServiceEntityRepository
{
    private EntityManagerInterface $entityManager;
    use ApiResponseTrait;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        parent::__construct($registry, Fruit::class);
    }

    public function save(Fruit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Fruit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
     * Get all fruits
     * @return array
     */
    public function getFruits(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('f')
            ->from(Fruit::class, 'f')
            ->leftJoin('f.fruitgenus', 'g')
            ->leftJoin('g.fruitfamily', 'ff')
            ->leftJoin('ff.FruitOrder', 'o')
            ->select('f.id as id, o.name as order, ff.name as family, g.name as genus, f.name as name, f.isFavourite as isFavourite')
            ->getQuery()
            ->getResult();


    }


    /**
     * Get favourite fruits
     * @return array
     */
    public function getFavouriteFruits(): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('f')
            ->from(Fruit::class, 'f')
            ->leftJoin('f.nutrition', 'n')
            ->select('f.id as id, f.name as name,  n.fat As fats, n.carbohydrates As carbs, n.protein As protein, n.calories As calories, n.sugar as sugar')
            ->where('f.isFavourite = :isFavourite')
            ->setParameter('isFavourite', true)
            ->getQuery()
            ->getResult();
    }

    /**
     * Get favourite fruits count
     * @return int
     */
    public function getFavouriteFruitsCount(): int
    {
        return count($this->getFavouriteFruits());
    }

    /**
     * Toggle favourite fruit
     * @param Fruit $fruit
     * @return Fruit
     */
    public function toggleFavouriteFruit(Fruit $fruit): Fruit
    {
        $fruit->setIsFavourite(!$fruit->getIsFavourite());
        $this->save($fruit, true);

        return $fruit;

    }

    /**
     * Get fruit by id
     */
    public function getFruitById(int $id): array
    {
        return $this->entityManager->createQueryBuilder()
            ->select('f')
            ->from(Fruit::class, 'f')
            ->leftJoin('f.fruitgenus', 'g')
            ->leftJoin('g.fruitfamily', 'ff')
            ->leftJoin('ff.FruitOrder', 'o')
            ->select('f.id as id, o.name as order, ff.name as family, g.name as genus, f.name as name, f.isFavourite as isFavourite')
            ->where('f.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
            ->getResult();
    }
}
