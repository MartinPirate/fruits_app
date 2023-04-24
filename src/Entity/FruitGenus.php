<?php

namespace App\Entity;

use App\Repository\FruitGenusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitGenusRepository::class)]
class FruitGenus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'fruitGenera')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FruitFamily $fruitfamily = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'fruitgenus', targetEntity: Fruit::class, orphanRemoval: true)]
    private Collection $fruits;

    public function __construct()
    {
        $this->fruits = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFruitfamily(): ?FruitFamily
    {
        return $this->fruitfamily;
    }

    public function setFruitfamily(?FruitFamily $fruitfamily): self
    {
        $this->fruitfamily = $fruitfamily;

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

    /**
     * @return Collection<int, Fruit>
     */
    public function getFruits(): Collection
    {
        return $this->fruits;
    }

    public function addFruit(Fruit $fruit): self
    {
        if (!$this->fruits->contains($fruit)) {
            $this->fruits->add($fruit);
            $fruit->setFruitgenus($this);
        }

        return $this;
    }

    public function removeFruit(Fruit $fruit): self
    {
        if ($this->fruits->removeElement($fruit)) {
            // set the owning side to null (unless already changed)
            if ($fruit->getFruitgenus() === $this) {
                $fruit->setFruitgenus(null);
            }
        }

        return $this;
    }
}
