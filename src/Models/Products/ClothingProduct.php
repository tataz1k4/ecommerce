<?php
namespace Scandiweb\Models\Products;

use Scandiweb\Models\Product;
use Scandiweb\Models\Attributes\SizeAttribute;
use Scandiweb\Models\Category;

class ClothingProduct extends Product
{
    protected function initializeAttributes(): void
    {
        $this->attributes[] = new SizeAttribute();
    }
}
