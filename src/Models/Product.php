<?php
namespace Scandiweb\Models;

use Scandiweb\Models\Price;
use Scandiweb\Models\Attribute\AttributeSet;
use Scandiweb\Models\Gallery;

class Product
{
    private int $id;
    private string $name;
    private bool $inStock;
    private string $description;
    private Category $category;
    
    /** @var Price[] */
    private array $prices = [];
    
    /** @var AttributeSet[] */ 
    private array $attributes = [];
    
    /** @var Gallery[] */
    private array $gallery = [];

    public function __construct(
        int $id,
        string $name,
        bool $inStock,
        string $description,
        Category $category
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->inStock = $inStock;
        $this->description = $description;
        $this->category = $category;
    }

    public function addPrice(Price $price): void
    {
        $this->prices[] = $price;
    }

    public function addAttributeSet(AttributeSet $attributeSet): void
    {
        $this->attributes[] = $attributeSet;
    }

    public function addGalleryImage(Gallery $image): void
    {
        $this->gallery[] = $image;
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
}