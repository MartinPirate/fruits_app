<?php

namespace App\Entity;

use App\Repository\FruitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Boolean;

#[ORM\Entity(repositoryClass: FruitRepository::class)]
class Fruit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fruits')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FruitGenus $fruitgenus = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;



    #[ORM\Column(type: 'boolean', options: ['default' => false])]

    private bool $isFavourite = false;



    #[ORM\OneToOne(mappedBy: 'fruit', cascade: ['persist', 'remove'])]
    private ?Nutrition $nutrition = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFruitgenus(): ?FruitGenus
    {
        return $this->fruitgenus;
    }

    public function setFruitgenus(?FruitGenus $fruitgenus): self
    {
        $this->fruitgenus = $fruitgenus;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    public function getNutrition(): ?Nutrition
    {
        return $this->nutrition;
    }

    public function setNutrition(Nutrition $nutrition): self
    {
        // set the owning side of the relation if necessary
        if ($nutrition->getFruit() !== $this) {
            $nutrition->setFruit($this);
        }

        $this->nutrition = $nutrition;

        return $this;
    }

    /**
     * @return bool
     */

    public function getIsFavourite(): bool
    {
        return $this->isFavourite;
    }

    /**
     * @param bool $isFavourite
     */
    public function setIsFavourite(bool $isFavourite): void
    {
        $this->isFavourite = $isFavourite;
    }
}
