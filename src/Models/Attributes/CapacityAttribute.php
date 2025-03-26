<?php
namespace Scandiweb\Models\Attributes;

class CapacityAttribute extends AttributeSet
{
    public function __construct()
    {
        parent::__construct("Capacity", "Capacity", "text");
    }
}
