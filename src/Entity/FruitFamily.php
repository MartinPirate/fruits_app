<?php

namespace App\Entity;

use App\Repository\FruitFamilyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitFamilyRepository::class)]
class FruitFamily
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'family')]
    #[ORM\JoinColumn(nullable: false)]
    private ?FruitOrder $FruitOrder = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'fruitfamily', targetEntity: FruitGenus::class, orphanRemoval: true)]
    private Collection $fruitGenera;

    public function __construct()
    {
        $this->fruitGenera = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFruitOrder(): ?FruitOrder
    {
        return $this->FruitOrder;
    }

    public function setFruitOrder(?FruitOrder $FruitOrder): self
    {
        $this->FruitOrder = $FruitOrder;

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
     * @return Collection<int, FruitGenus>
     */
    public function getFruitGenera(): Collection
    {
        return $this->fruitGenera;
    }

    public function addFruitGenus(FruitGenus $fruitGenus): self
    {
        if (!$this->fruitGenera->contains($fruitGenus)) {
            $this->fruitGenera->add($fruitGenus);
            $fruitGenus->setFruitfamily($this);
        }

        return $this;
    }

    public function removeFruitGenus(FruitGenus $fruitGenus): self
    {
        if ($this->fruitGenera->removeElement($fruitGenus)) {
            // set the owning side to null (unless already changed)
            if ($fruitGenus->getFruitfamily() === $this) {
                $fruitGenus->setFruitfamily(null);
            }
        }

        return $this;
    }
}
