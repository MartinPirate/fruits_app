<?php

namespace App\Entity;

use App\Repository\FruitOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FruitOrderRepository::class)]
class FruitOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'FruitOrder', targetEntity: FruitFamily::class, orphanRemoval: true)]
    private Collection $family;

    public function __construct()
    {
        $this->family = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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
     * @return Collection<int, FruitFamily>
     */
    public function getFamily(): Collection
    {
        return $this->family;
    }

    public function addFamily(FruitFamily $family): self
    {
        if (!$this->family->contains($family)) {
            $this->family->add($family);
            $family->setFruitOrder($this);
        }

        return $this;
    }

    public function removeFamily(FruitFamily $family): self
    {
        if ($this->family->removeElement($family)) {
            // set the owning side to null (unless already changed)
            if ($family->getFruitOrder() === $this) {
                $family->setFruitOrder(null);
            }
        }

        return $this;
    }
}
