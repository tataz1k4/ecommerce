<?php
namespace Scandiweb\Models;

use Scandiweb\Models\Price;
use Scandiweb\Models\Attributes\AttributeSet;
use Scandiweb\Models\Gallery;

abstract class Product
{
    private int $id;
    private string $name;
    private bool $inStock;
    private string $description;
    private Category $category;
    private string $brand;
    
    /** @var Price[] */
    private array $prices = [];
    
    /** @var AttributeSet[] */ 
    protected array $attributes = [];
    
    /** @var Gallery[] */
    private array $gallery = [];

    public function __construct(
        int $id,
        string $name,
        bool $inStock,
        string $description,
        Category $category,
        string $brand
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->inStock = $inStock;
        $this->description = $description;
        $this->category = $category;
        $this->brand = $brand;
    }

    public function addPrice(Price $price): void
    {
        $this->prices[] = $price;
    }

    public function addGalleryImage(Gallery $image): void
    {
        $this->gallery[] = $image;
    }

    abstract protected function initializeAttributes(): void;

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    // Getters
    public function getCategory(): Category
    {
        return $this->category;
    }

    /** @return Price[] */
    public function getPrices(): array
    {
        return $this->prices;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }
}
