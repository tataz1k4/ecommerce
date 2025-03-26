<?php
namespace Scandiweb\Models\Products;

use Scandiweb\Models\Product;
use Scandiweb\Models\Attributes\ColorAttribute;
use Scandiweb\Models\Attributes\CapacityAttribute;
use Scandiweb\Models\Category;

class TechProduct extends Product
{
    protected function initializeAttributes(): void
    {
        $this->attributes[] = new ColorAttribute();
        $this->attributes[] = new CapacityAttribute();
    }
}
