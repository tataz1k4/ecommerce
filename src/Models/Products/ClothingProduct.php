<?php
namespace Scandiweb\Models\Products;

use Scandiweb\Models\Product;
use Scandiweb\Models\Attributes\SizeAttribute;

class ClothingProduct extends Product
{
    protected function initializeAttributes(): void
    {
        $this->attributes[] = new SizeAttribute();
    }
}
