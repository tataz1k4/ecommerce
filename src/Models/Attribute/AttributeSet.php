<?php
namespace Scandiweb\Models\Attribute;

use Scandiweb\Models\Product;

class AttributeSet
{
    private int $id;
    private string $name;
    private string $type;
    private Product $product;

    public function __construct(
        int $id,
        string $name,
        string $type,
        Product $product
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->product = $product;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getProduct(): Product 
    {
        return $this->product; 
    }
}