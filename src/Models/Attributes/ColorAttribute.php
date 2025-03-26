<?php
namespace Scandiweb\Models\Attributes;

class ColorAttribute extends AttributeSet
{
    public function __construct()
    {
        parent::__construct("Color", "Color", "swatch");
    }
}
