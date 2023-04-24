<?php
namespace App\Dtos;

class FruitDTO
{
    public ?int $id = null;
    public ?int $fruitgenus = null;
    public ?string $name = null;
    public bool $isFavourite = false;
    public ?NutritionDTO $nutrition = null;
}