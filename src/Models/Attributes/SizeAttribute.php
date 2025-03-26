<?php
namespace Scandiweb\Models\Attributes;

class SizeAttribute extends AttributeSet
{
    public function __construct()
    {
        parent::__construct("Size", "Size", "text");
    }
}
